<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\ClassSetup as ClassSetupModel;
use App\ClassSetupDetail as ClassSetupDetailModel;
use App\GradeModel as GradeModel;
use App\Section as SectionModel;
use App\AttendanceLog as AttendanceLogModel;
use App\Student as StudentModel;
use Auth;
use Session;
use Carbon\Carbon;
use App\User as UserModel;
class ScanController extends Controller
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

        return view('scan.scan')
        ->with('grades',GradeModel::all())
        ->with('classes',ClassSetupModel::where('adviser',Auth::user()->id)->get())
        ->with('sections',SectionModel::all());
    }

    function searchstudent(Request $request)
    {
        
        $student_id = $request->student_id;

        $active_class = $request->clases;

        $get_info = StudentModel::where('qr_image',$student_id)->first();

        $checkIfOnClass = ClassSetupDetailModel::where('class_id',$active_class)->where('student_id',$get_info->id)->where('status',1)->count();

        if ($checkIfOnClass < 1) {
            return 0;
        }
        else
        {
            return 1;
        }
        
    }


    public function timeIn(Request $request)
    {
        $mytime = Carbon::now()->setTimezone('Asia/Manila');
        $format = $mytime->format('H:i:s');
        $format_date = $mytime->format('Y-m-d');
        // return $request->all();
        $data = [
            'student_id' => $request->student_id,
            'class_id' => $request->class,
            'date_in' => $format_date,
            'time_in' => $format,
        ];

        //VALIDATE
        
        $counter = AttendanceLogModel::where('student_id',$request->student_id)->where('class_id',$request->class)->where('date_in',$format_date)->count();
        // return $counter;
        if ($counter > 0) {
            Session::flash('failed','Attendance for today already exist');
            return redirect()->route('scan.index');
        }

        AttendanceLogModel::insert($data);

        Session::flash('success','Success');
        return redirect()->route('scan.index');
    }

}
