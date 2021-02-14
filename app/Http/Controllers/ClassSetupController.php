<?php

namespace App\Http\Controllers;

use App\ClassSetup;
use App\GradeModel;
use App\Section;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class ClassSetupController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {;
        return view('class_setup.class')
        ->with('classSetup',ClassSetup::all());
    }


    public function studentQR()
    {
        // $test = ClassSetup::first();
        // return QrCode::size(500)->generate($test->qr_image);
        return view('layouts.studentQR');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('class_setup.classInsert')
        ->with('section',Section::get())
        ->with('student',Student::get())
        ->with('grade',GradeModel::get())
        ->with('user',User::where('user_level',1)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $createClass = [
            'grade' => $request->grade,
            'section' => $request->section,
            'subject' => $request->subject,
            'adviser' => $request->adviser,
            'time_start' => $request->time_start,
            'status' => 1,
            'time_end' => $request->time_end,
        ];

        ClassSetup::insert($createClass);

        return redirect()->route('class.setup.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function getDetail($id)
    {
        //
        // return $id;

        return view('class_setup.classEdit')
        ->with('section',Section::get())
        ->with('student',Student::get())
        ->with('grade',GradeModel::get())
        ->with('user',User::where('user_level',1)->get())
        ->with('info',ClassSetup::where('id',$id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $createClass = [
            'grade' => $request->grade,
            'section' => $request->section,
            'subject' => $request->subject,
            'adviser' => $request->adviser,
            'time_start' => $request->time_start,
            'status' => 1,
            'time_end' => $request->time_end,
            'capacity' => $request->capacity
        ];

        ClassSetup::where('id',$request->class_id)->update($createClass);

        return redirect()->route('class.setup.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function delete(Request $request)
    {
        // return $request->all();
        //Validate usernane
        // return $create;
        ClassSetup::where('id',$request->user_id)->update(['status' => '0']);

        return response()->json(['status' => '1']);
        // return back();
    }
}
