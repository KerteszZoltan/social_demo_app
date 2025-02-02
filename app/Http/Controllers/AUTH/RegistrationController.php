<?php

namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{

    public function index(){
        return view('registration');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required | email ',
            'password' => 'required | confirmed | min:8 | max:20'
        ]);
        $checkEmail = User::where('email','=',$request->email)->count();
        $userCount = User::all()->count();
        if ($userCount==0) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => true,
                'admin' => true,
            ]);
        return redirect()->route('home');

        }

        if($checkEmail==0){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['msg'=>'The email is already used']);
        }


    }
}
