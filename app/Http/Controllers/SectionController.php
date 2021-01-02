<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Section as SectionModel;
use App\GradeModel as GradeModel;
class SectionController extends Controller
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
    
        return view('section.section')
        ->with('grades',GradeModel::all())
        ->with('sections',SectionModel::all());
    }


    public function insert(Request $request)
    {
        // return $request->all();
        //Validate usernane

        $create  =[
            'grade_level' => $request->grade,
            'section' => $request->section,
            'status' => '1',
        ];
        // return $create;
        SectionModel::create($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function getDetail(Request $request)
    {
        $getDetails = SectionModel::where('id',$request->section_id)->first();

        return response()->json([
            'grade_level' => $getDetails->grade_level,
            'section' => $getDetails->section,
            'section_id' => $request->section_id,
        ]);
    }



    public function update(Request $request)
    {
        // return $request->all();
        //Validate usernane

        $create  =[
            'grade_level' => $request->grade_level,
            'section' => $request->section,
        ];
        // return $create;
        // return $create;
        SectionModel::where('id',$request->grade_id)->update($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function delete(Request $request)
    {
        // return $request->all();
        //Validate usernane
        // return $create;
        SectionModel::where('id',$request->user_id)->delete();

        return response()->json(['status' => '1']);
        // return back();
    }
}
