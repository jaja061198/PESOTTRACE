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
        return view('class_setup.classinsert')
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
        //
        //
        $f_fname = $request->lname;
        $id = substr($request->fname, 0,1);
        $randomNumber = rand(999,10000);
        $uniqueID = strtoupper($f_fname.$id.$randomNumber);

        $createStudent = [
            'f_name' => $request->fname,
            'm_name' => $request->mname,
            'l_name' => $request->lname,
            'gender' => $request->gender,
            'b_day' => $request->b_day,
            // 'student_id' => $request->student_id,
            'image' => $request->image,
            'qr_image' => $uniqueID,
        ];

        ClassSetup::insert($createStudent);

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

        return view('class_setup.studentEdit')
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

        $createStudent = [
            'f_name' => $request->fname,
            'm_name' => $request->mname,
            'l_name' => $request->lname,
            'gender' => $request->gender,
            'b_day' => $request->b_day,
            // 'student_id' => $request->student_id,
        ];

        ClassSetup::where('id',$request->student_id)->update($createStudent);

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

    function studentQRGenerate(Request $request)
    {
        $details = ClassSetup::where('qr_image',$request->user_id)->first();

        if ($details != null) {
             return view('layouts.studentQRDetails')
             ->with('studentDetails',$details)
             ->with('qrCode',QrCode::size(500)->generate($details->qr_image));
        }

            return back();
    }

    public function delete(Request $request)
    {
        // return $request->all();
        //Validate usernane
        // return $create;
        ClassSetup::where('id',$request->user_id)->delete();

        return response()->json(['status' => '1']);
        // return back();
    }
}
