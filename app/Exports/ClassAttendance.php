<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\ClassSetup as ClassSetupModel;
use App\AttendanceLog as AttendanceLogModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClassAttendance implements FromView
{
    // public function collection()
    // {
    //     return ClassSetupModel::all();
    // }

    // public function forYear(int $year)
    // {
    //     $this->year = $year;
        
    //     return $this;
    // }

    // public function query()
    // {
    //     return Invoice::query()->whereYear('created_at', $this->year);
    // }
    
    public function __construct($request)
    {
        $this->date = $request->date;
        $this->class = $request->class;
    }
    public function view(): View
    {
        return view('generate_attendance.generate_result', [
            'detail' => AttendanceLogModel::where('class_id',$this->class)->where('date_in',$this->date)->with('getClass')->get()
        ]);
    }
}

