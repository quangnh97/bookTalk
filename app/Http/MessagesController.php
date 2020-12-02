<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\friendships;
use App\notifcations;
use App\User;

class MessagesController extends Controller
{

    // get list messaged
    public function getMessages(){
        $allUsers1 = DB::table('users')
        ->join('conversation','users.id','conversation.user_one')
        ->where('conversation.user_two', Auth::user()->id)->get();
        

        $allUsers2 = DB::table('users')
        ->join('conversation','users.id','conversation.user_two')
        ->where('conversation.user_one', Auth::user()->id)->get();
        
        return array_merge($allUsers1->toArray(), $allUsers2->toArray());
    }

    // get detail a messaged
    public function getDetailMessage($id){
        //update cov status
        $update_status = DB::table('conversation')->where('id',$id)
        ->update([
          'status' => 0 // now read by user
        ]);
    
        $userMsg = DB::table('messages')
        ->join('users', 'users.id','messages.user_from')
        ->where('messages.conversation_id', $id)
        ->orderBy('messages.created_at','ASC')
        ->get();
        // dd($userMsg);  
        return $userMsg;
      }

    public  function sendMessage(Request $request){
        $conID = $request->conID;
        $msg = $request->msg;
  
        $checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
        if($checkUserId[0]->user_from== Auth::user()->id){
            // fetch user_to
            $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
            ->where('user_to','!=',Auth::user()->id)
            ->get();
            $userTo = $fetch_userTo[0]->user_to;
        }else{
        // fetch user_to
        $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
        ->get();
        $userTo = $fetch_userTo[0]->user_to;
        }
  
        // now send message
        $sendM = DB::table('messages')->insert([
            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'msg' => $msg,
            'status' => 1,
            'conversation_id' => $conID
        ]);

        if($sendM){
            $userMsg = DB::table('messages')
            ->join('users', 'users.id','messages.user_from')
            ->where('messages.conversation_id', $conID)
            ->orderBy('messages.created_at','ASC')
            ->get();
            return $userMsg;
        }
    }

    public function newMessage(){
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
        ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
        ->where('status', 1)
        ->where('requester', $uid) // who is loggedin
        ->get();

        $friends2 = DB::table('friendships')
        ->leftJoin('users', 'users.id', 'friendships.requester')
        ->where('status', 1)
        ->where('user_requested', $uid)
        ->get();

        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return $friends;
    }

    public function newMessageEveryAll($id){
        
        return view('messages.newMessageWithEveryAll')->with('id',$id);
    }

    public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        // check if conversation already started or not 
        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
        ->where('user_two',$friend_id)->get(); 
        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
        ->where('user_one',$friend_id)->get(); 
        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());

        if(count($allCons)!=0){

            // old conversation
            $conID_old = $allCons[0]->id;

            //insert data into messages table
            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_old,
                'status' => 1
            ]);
        }else { // if not conversaion
            // new conversation
            $conID_new = DB::table('conversation')->insertGetId([
                'user_one' => $myID,
                'user_two' => $friend_id
            ]);
            echo $conID_new;
            $MsgSent = DB::table('messages')->insert([
                'user_from' => $myID,
                'user_to' => $friend_id,
                'msg' => $msg,
                'conversation_id' =>  $conID_new,
                'status' => 1
            ]);
        }
    }
}
