<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Http\Requests\ProfessorStore;
use App\ImageModel;
use Image;
use App\Professors_Subject;
use App\Subject;
use App\User;
use App\Http\Requests\ProfessorSubjectStore;

class ProfessorsController extends Controller
{


     public function __construct()
    {
        $this->middleware('admin')->only(['create','store','edit','update','destroy', 'create_subject', 'store_subject', 'destroy_subject']);
        $this->middleware('professor')->only(['profile', 'edit_password', 'update_password']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professor = Professor::all();

        return view('professor.index', compact('professor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessorStore $request)
    {
        $data=$request->all();
        if($request->hasFile('picture') != ''){
            $file=$request->file('picture');
                $img=Image::make($file)->resize(100, 100);
                $path=public_path('/professors_images');
                $img_name=time().'_'.$file->getClientOriginalName();
                $img->save($path.'/'.$img_name);
        }
        $data['picture']=$img_name;

        $this->validate($request, [
             'password' => 'required|string|min:6|max:20|same:identification_number',
        ]); 
        $data['password'] = bcrypt(request('password'));
        
         Professor::create($data);

        return redirect('professors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Professor $professor)
    {
        $subjects = $professor->subjects;

        return view('professor.show', ['professor'=>$professor], compact('subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Professor $professor)
    {       
        return view('professor.edit', compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessorStore $request, $id)
    {
        $professor = Professor::findorfail($id); 
        $user = User::where('email', $professor->email)->first();
        $professor->update($request->all());
        $user->update($request->all());

        return redirect('/professors');
    }


    public function edit_password_from_service(Professor $professor_id)
    {
        return view('professor.edit_password_from_service', ['professor'=>$professor_id]);
    }


    public function update_password_from_service(Request $request, $professor_id)
    {
        $professor = Professor::findOrFail($professor_id);
        $this->validate($request, [
             'password' => 'required|string|min:6|max:20',
        ]);
        $data['password'] = bcrypt(request('password'));

        $professor->update($data);

        $user = User::where('email', $professor->email)->first();
        $user->update($data);

        return redirect('/professors');
    }


    public function destroy(Professor $professor)
    {
        $professor->delete();

        return redirect('/professors');
    }


    public function create_subject($professor_id)
    {
        $professor = Professor::findorfail($professor_id);
        $subject = Subject::all();
        return view('professor.create_subject', compact('professor', 'subject'));
    }


    public function store_subject(ProfessorSubjectStore $request, $professor_id){
        $data['professor_id'] = $professor_id;
        $subjects_id = request('subject_id');
        $subjects = Subject::whereIn('id', $subjects_id)->get();

        foreach ($subjects as $subject) {
            $data['subject_id'] = $subject['id'];
            $validated = $request->validated();
            Professors_Subject::create($data);
        }

        return redirect('/professors/' . $professor_id);        
    }


    public function destroy_subject($subject_id, $professor_id)
    {
        Professors_Subject::where('subject_id', $subject_id)->where('professor_id', $professor_id)->delete();

        return redirect('/professors/' . $professor_id);
    }


    public function profile(){
        $professor = Professor::where('email', auth()->user()->email)->get();

        return view('professor.profile', compact('professor'));
    }


    public function edit_password(){
        return view('professor.edit_password');
    }


    public function update_password(Request $request){
        $this->validate($request, [
             'password' => 'required|string|min:6|max:20|confirmed',
             'password_confirmation'=>'sometimes|required_with:password',
        ]); 
        $password = bcrypt(request('password'));
        $user = User::where('email', auth()->user()->email)->first();

        if ($user) {
            $user->password = $password;
            $user->save();
        }

        return redirect('/professor/profile');
        }


}
