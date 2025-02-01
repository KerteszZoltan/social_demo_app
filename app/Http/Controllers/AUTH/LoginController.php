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

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }
 
        return back()->withErrors([
            'email' => 'Hibas email vagy jelszo',
        ])->onlyInput('email');


    }
}
