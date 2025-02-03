<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AddFriendNotification;
use App\Models\User;


use App\Models\Friend;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;
        return view('notifications',[
            'unreadNotifications'=>$unreadNotifications,
            'readNotifications'=>$readNotifications,
        ]);
    }

    public function addBack(Request $request){
        $exist = Friend::where([
            ['friend_id', $request->id],
            ['owner_id', Auth::user()->id],
        ])->count();
        if($exist == 0){
            Friend::create([
                'owner_id' => Auth::user()->id,
                'friend_id' =>$request->id,
            ]);
            Friend::where(function ($query) use ($request) {
                $query->where('owner_id', Auth::user()->id)
                      ->where('friend_id', $request->id);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('owner_id', $request->id)
                      ->where('friend_id', Auth::user()->id);
            })
            ->update([
                'pending' => 0,
                'accepted' => 1,
            ]);
        $notification = auth()->user()->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->markAsRead();
        }
        $sender= Auth::user();
        $recevier = User::where('id','=',$request->id)->first();
        $recevier->notify( new AddFriendNotification($sender,'Accepted your frend request!'));
        }else{
            return redirect()->back()->withErrors(['msg'=>'He/she your friend']);
        }

        return redirect()->route('allNotifications');
    }

    public function decline(Request $request){

        $change = Friend::where(function ($query) use ($request) {
            $query->where('owner_id', Auth::user()->id)
                  ->where('friend_id', $request->sender_id);
        })
        ->orWhere(function ($query) use ($request) {
            $query->where('owner_id', $request->sender_id)
                  ->where('friend_id', Auth::user()->id);
        })
        ->update([
            'pending' => 0,
            'accepted' => 0,
            'declined' => 1,
        ]);
        $notification = auth()->user()->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->markAsRead();
        }
        $sender= Auth::user();
        $recevier = User::where('id','=',$request->sender_id)->first();
        $recevier->notify( new AddFriendNotification($sender,'Declined your frend request!'));
        return redirect()->route('allNotifications');
    }

    public function markRead(Request $request){
        $notification = auth()->user()->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->route('allNotifications');

    }
}
