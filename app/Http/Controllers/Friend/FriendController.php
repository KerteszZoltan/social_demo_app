<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Notification;


use App\Notifications\AddFriendNotification;


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
                'friend_id' =>$request->id,
                'owner_id' => Auth::user()->id,
            ]);
            $sender= Auth::user();
            $recevier = User::where('id','=',$request->id)->first();
            $recevier->notify( new AddFriendNotification($sender,'I want add you to my friends list'));
        }else{
            return redirect()->back()->withErrors(['msg'=>'He/she your friend']);
        }

        return redirect()->route('allFriends');
    }

    public function friends(){
        $friends = Friend::join('users', 'friends.friend_id' ,'=', 'users.id')
        ->where([
            ['owner_id', Auth::user()->id],
        ])->select('users.name', 'users.email', 'friends.pending','friends.declined', 'friends.accepted','friends.id')
        ->get();

        return view('friends', ['friends'=>$friends]);
    }

    public function delete(Request $request){

        Friend::where('id', $request->id)->delete();
        return redirect()->route('allFriends');

    }


}
