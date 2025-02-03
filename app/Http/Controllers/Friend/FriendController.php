<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friend;

use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend(Request $request){
        $exist = Friend::where([
            ['friend_id', $request->id],
            ['owner_id', Auth::user()->id],
        ])->count();

        if($exist == 0){
            Friend::create([
                'owner_id' => Auth::user()->id,
                'friend_id' =>$request->id,
            ]);
        }else{
            return redirect()->back()->withErrors(['msg'=>'He/she your friend']);
        }

        return redirect()->route('allFriends');
    }

    public function friends(){
        $friends = Friend::join('users', 'friends.friend_id' ,'=', 'users.id')
        ->where([
            ['owner_id', Auth::user()->id],
        ])->select('users.name', 'users.email', 'friends.pending', 'friends.accepted','friends.id')
        ->get();

        return view('friends', ['friends'=>$friends]);
    }

    public function delete(Request $request){
        try {
            Friend::where('id', $request->id)->delete();
            return redirect()->route('allFriends');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['msg' => 'Delete not working']);
        }

    }
}
