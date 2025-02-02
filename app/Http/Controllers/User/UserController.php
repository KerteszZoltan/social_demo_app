<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;


use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::where('id', '!=', Auth::user()->id)->orderBy('active', 'asc')->get();
        return view('users',['users' => $users]);
    }

    public function updateAdmin(Request $request){
        if ($request->admin == 'on') {
            $request->admin = 1;
        }else{
            $request->admin = 0;

        }
        if ($request->active == 'on') {
            $request->active = 1;
        }else{
            $request->active=0;

        }
        try {
            $user = User::where('id', $request->id)
                ->update([
                    'admin' => $request->admin,
                    'active'=> $request->active,
                ]);

            return redirect()->route('allusers');
        } catch (\Throwable $th) {
            return back()->withErrors([
                'error' => 'The saving process is not complete',
            ]);
        }
    }


}
