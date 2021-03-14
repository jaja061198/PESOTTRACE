<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;
use App\Section as SectionModel;
Use App\GradeModel as GradeModel;
use App\Student as StudentModel;
use App\AttendanceLog as AttendanceLogModel;
use App\Exports\ClassAttendance;
use App\ClassSetup as ClassSetupModel;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class GenerateAttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('generate_attendance.generate_attendance')
        ->with('class',ClassSetupModel::all());
    }

    public function generate(Request $request)
    {   
        return Excel::download(new ClassAttendance($request),'attendance.xlsx');
    }
}
