<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = User::all();
        return view('users',['users' => $users]);
    }

    public function update(Request $request){
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
        $user = User::where('id', $request->id)
                ->update([
                    'admin' => $request->admin,
                    'active'=> $request->active,
                ]);
        $updatedUser = User::where('id', $request->id)->get();

        print $user;
        print '////////////';
        print $updatedUser;
    }
}
