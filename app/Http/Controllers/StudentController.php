<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {;
        return view('students.student')
        ->with('students',Student::all());
    }


    public function studentQR()
    {
        // $test = Student::first();
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
        return view('students.studentinsert');
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

        Student::insert($createStudent);

        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
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
        $details = Student::where('qr_image',$request->user_id)->first();

        if ($details != null) {
             return view('layouts.studentQRDetails')
             ->with('studentDetails',$details)
             ->with('qrCode',QrCode::size(500)->generate($details->qr_image));
        }

            return back();
    }
}
