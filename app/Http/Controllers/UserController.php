<?php

namespace App\Http\Controllers;

use App\Exports\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User as UserModel;
class UserController extends Controller
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

        // return Excel::download(new UserCollection,'users.xlsx');
        return view('app_manager.user')
        ->with('users',UserModel::all());
    }


    public function insert(Request $request)
    {
        // return $request->all();
        //Validate usernane
        $count = UserModel::where('user_id',$request->user_id)->count();

        if ($count > 0) {
            return response()->json(['status' => '0']);
        }

        $create  =[
            'user_id' => $request->user_id,
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'l_name' => $request->l_name,
            'password' => Hash::make($request->password),
            'user_level' => $request->user_level,
        ];
        // return $create;
        UserModel::create($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function getDetail(Request $request)
    {
        $getDetails = UserModel::where('user_id',$request->user_id)->first();

        return response()->json([
            'f_name' => $getDetails->f_name,
            'm_name' => $getDetails->m_name,
            'l_name' => $getDetails->l_name,
            'user_id' => $getDetails->user_id,
            'password' => $getDetails->password,
            'user_level' => $getDetails->user_level,
        ]);
    }



    public function update(Request $request)
    {
        // return $request->all();
        //Validate usernane

        $create  =[
            'f_name' => $request->f_name,
            'm_name' => $request->m_name,
            'l_name' => $request->l_name,
            'user_level' => $request->user_level,
        ];
        // return $create;
        UserModel::where('user_id',$request->user_id)->update($create);

        return response()->json(['status' => '1']);
        // return back();
    }


    public function delete(Request $request)
    {
        // return $request->all();
        //Validate usernane
        // return $create;
        UserModel::where('user_id',$request->user_id)->delete();

        return response()->json(['status' => '1']);
        // return back();
    }
}
