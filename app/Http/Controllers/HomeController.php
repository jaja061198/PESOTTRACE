<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserModel;
use App\Section as SectionModel;
Use App\GradeModel as GradeModel;

class HomeController extends Controller
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
        return view('home')
        ->with('teacher_count',UserModel::where('user_level',1)->count())
        ->with('sec_count',SectionModel::count())
        ->with('grade_count',GradeModel::count());
    }
}
