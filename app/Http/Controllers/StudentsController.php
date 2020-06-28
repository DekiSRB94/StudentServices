<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Student;
use App\Subject;
use App\Students_Subject;
use App\Http\Requests\StudentStore;
use App\Http\Requests\StudentSubjectStore;
use App\ImageModel;
use Image;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Register_Exam;
use App\Http\Requests\RegisterExamStore;
use App\Exams_option;
use App\Professor;
use App\Professors_Subject;


class StudentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy', 'create_subject', 'store_subject', 'destroy_subject', 'edit_balance', 'update_balance']);
        $this->middleware('student')->only(['profile', 'edit_password', 'update_password', 'register_exam', 'store_exam']);
        $this->middleware('professor')->only(['edit_exam_mark', 'update_exam_mark']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::paginate(100);

        return view('student.index', compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStore $request)
    {
        $data=$request->all();
        if($request->hasFile('picture') != ''){
            $file=$request->file('picture');
                $img=Image::make($file)->resize(100, 100);
                $path=public_path('/students_images');
                $img_name=time().'_'.$file->getClientOriginalName();
                $img->save($path.'/'.$img_name);
        }
        $data['picture']=$img_name;

        $this->validate($request, [
             'password' => 'required|string|min:6|max:20|same:identification_number',
        ]); 
        $data['password'] = bcrypt(request('password'));

         Student::create($data);

        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $subjects = $student->subjects;
        $student_subject = Students_Subject::all();

        $exams_option = Exams_option::where('id', 1)->first();
        $register_exam = Register_Exam::where('examination_period', $exams_option->examination_period)->where('year', date('Y'))->get();

        if(auth()->check() && auth()->user()->role == 2){
            $professor = Professor::where('email', auth()->user()->email)->first();
            $professor_subject = Professors_Subject::where('professor_id', $professor->id)->get();
        }

        return view('student.show', ['student'=>$student], compact('subjects', 'student_subject', 'register_exam', 'professor_subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentStore $request, $id)
    {
        $student = Student::findOrFail($id);
        $user = User::where('email', $student->email)->first();
        $student->update($request->all());
        $user->update($request->all());

        return redirect('/students/');
    }


    public function edit_password_from_service(Student $student_id)
    {
        return view('student.edit_password_from_service', ['student'=>$student_id]);
    }


    public function update_password_from_service(Request $request, $student_id)
    {
        $student = Student::findOrFail($student_id);
        $this->validate($request, [
             'password' => 'required|string|min:6|max:20',
        ]);
        $data['password'] = bcrypt(request('password'));

        $student->update($data);

        $user = User::where('email', $student->email)->first();
        $user->update($data);

        return redirect('/students');
    }


    public function destroy(Student $student)
    {
       $student->delete();

       return redirect('/students');
    }


    public function create_subject($student_id)
    {
        $student = Student::findOrFail($student_id);
        $subject = Subject::all();

        return view('student.create_subject', compact('student', 'subject'));
    }


    public function store_subject(StudentSubjectStore $request, $student_id)
    {
        $data['student_id'] = $student_id;
        
        foreach(request('subject_id') as $subject_id) {
            $data['subject_id'] = $subject_id;   
            try {
                Students_Subject::create($data);
                return redirect('/students/' . $student_id)->with('message1', 'Subject succesfully added !');
            } catch (\Exception $exception){
                return redirect('/students/' . $student_id)->with('message2', 'Subject already exist !');
            }
        }

        return redirect('/students/' . $student_id);
    }


    public function destroy_subject($subject_id, $student_id)
    {
       Students_Subject::where('subject_id', $subject_id)->where('student_id', $student_id)->delete();

       return redirect('/students/' . $student_id);
    }


    public function profile(){
        $student = Student::where('email', auth()->user()->email)->get();
        //$user = auth()->user()->id;

        return view('student.profile', compact('student'));
    }


    public function edit_password(){
        $user = User::where('email', auth()->user()->email)->first();

        return view('student.edit_password', compact('user'));
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

        return redirect('/student/profile');
        }


    public function register_exam(){
        $student = Student::where('email', auth()->user()->email)->first();
        $subjects = $student->subjects;
        $student_subject = Students_Subject::all();
        $exams_options = Exams_option::where('id', 1)->first();

        return view('student.register_exam', ['student'=>$student], compact('subjects', 'student_subject', 'exams_options'));
    }


    public function store_exam(RegisterExamStore $request){
        $student = Student::where('email', auth()->user()->email)->first();
        $exams_options = Exams_option::where('id', 1)->first();

        $data=$request->all();
        $data['student_id'] = $student->id;
        $data['examination_period'] = $exams_options->examination_period;

        $subject_name = request('subject_name');
        $register_exam = Register_Exam::where('examination_period', $exams_options->examination_period)->where('year', date('Y'))->where('student_id', $student->id)->where('subject_name', $subject_name)->first();

        if($student->account_balance >= 1500 && $exams_options->status == 'Active' && !Register_Exam::all()->contains($register_exam)){
                $student->account_balance -= 1500;
                $student->save();
                Register_Exam::create($data);
                return redirect('/register_exam')->with('message', 'You succesfully register the exam !');
            }
            else{
                return redirect('/register_exam')->with('message2', 'You already register this exam !');
            }
        }


    public function edit_balance($student_id){
        $student = Student::findOrFail($student_id);

        return view('student.edit_balance', compact('student'));
    }


    public function update_balance(Request $request, $student_id){
        $student = Student::findOrFail($student_id);
        $this->validate($request, [
             'account_balance' => ['required','numeric','min:500'],
        ]); 
        $student->account_balance = request('account_balance');
        $student->save();

        return redirect('students');
    }


    public function edit_exam_mark($student_id, $subject_id){
        $student_subject = Students_Subject::where('student_id', $student_id)->where('subject_id', $subject_id)->first();

        return view('student.edit_exam_mark', compact('student_subject'));
    }


    public function update_exam_mark(Request $request, $student_id, $subject_id){
        $subject = Subject::where('id', $subject_id)->first();
        $exams_option = Exams_option::where('id', 1)->first();
        $register_exam = Register_Exam::where('student_id', $student_id)->where('subject_name', $subject->name)->where('examination_period', $exams_option->examination_period)->where('year', date('Y'))->where('status', 'Active')->first();

        $student_subject = Students_Subject::where('student_id', $student_id)->where('subject_id', $subject_id)->first();
        $this->validate($request, [
             'mark' => ['required','regex:/^(5|6|7|8|9|10)$/i'],
        ]); 
        $student_subject->mark = request('mark');
        $student_subject->save();

        if($student_subject->mark == 5){
            $register_exam->status = 'Failed';
            $register_exam->save();
        }
        if($student_subject->mark > 5){
            $register_exam->status = 'Passed';
            $register_exam->save();
        }

        return redirect('/students/' . $student_id);
    }


    public function show_exams_history(){
        $student = Student::where('email', auth()->user()->email)->first();
        $register_exam = Register_Exam::where('student_id', $student->id)->get();

        return view('student.exams_history', compact('student', 'register_exam'));
    }


}
