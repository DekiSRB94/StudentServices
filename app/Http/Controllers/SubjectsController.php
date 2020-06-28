<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Http\Requests\SubjectStore;
use App\Exams_option;
use App\Http\Requests\ExamOptionStore;

class SubjectsController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin')->only(['create','store','edit','update','destroy','edit_options','update_options']);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::all();
        
        return view('subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectStore $request)
    {
        Subject::create($request->all());

        return redirect('/subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectStore $request, $id)
    {
        $subject = Subject::findorfail($id);
        $subject->update($request->all());

        return redirect('/subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    { 
        $subject->delete();

        return redirect('/subjects');
    }


    public function edit_options(){
        $options = Exams_option::where('id', 1)->first();

        return view('subject.edit_options', compact('options'));
    }


    public function update_options(ExamOptionStore $request){
        $options = Exams_option::where('id', 1)->first();
        $options->update($request->all());

        return redirect('subjects');
    }


}
