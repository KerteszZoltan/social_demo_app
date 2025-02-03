<?php

namespace App\Http\Controllers\AUTH;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function store(Request $request){
        $data = $request->validate([
            'email' => 'required | email',
            'password' => 'required | min:8 | max:20'
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if($user && $user->active){
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }else{
                return back()->withErrors([
                    'email' => 'Wrong password or email',
                ])->onlyInput('email');
            }
        }else{
            return back()->withErrors([
                'email' => 'The account is inactive',
            ])->onlyInput('email');
        }
    }
}
