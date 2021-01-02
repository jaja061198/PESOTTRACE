<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\GradeModel as GradeModel;
class GradeController extends Controller
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
        return view('grade.grade')
        ->with('grades',GradeModel::all());
    }


    public function insert(Request $request)
    {
        // return $request->all();
        //Validate usernane

        $create  =[
            'grade_level' => $request->grade,
            'status' => '1',
        ];
        // return $create;
        GradeModel::create($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function getDetail(Request $request)
    {
        $getDetails = GradeModel::where('id',$request->grade_id)->first();
        return response()->json([
            'grade_level' => $getDetails->grade_level,
            'grade_id' => $request->grade_id,
        ]);
    }



    public function update(Request $request)
    {
        // return $request->all();
        //Validate usernane

        $create  =[
            'grade_level' => $request->grade_level,
        ];
        // return $create;
        GradeModel::where('id',$request->grade_id)->update($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function delete(Request $request)
    {
        // return $request->all();
        //Validate usernane
        // return $create;
        GradeModel::where('id',$request->user_id)->delete();

        return response()->json(['status' => '1']);
        // return back();
    }
}
