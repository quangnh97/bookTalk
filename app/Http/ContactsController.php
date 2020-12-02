<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Events\NewMessage;
use DB;
use App\Events\RedisEvent;

class ContactsController extends Controller
{
    public function get()
    {
        // lấy tat ca list nguoi dung, tru auth
        $contacts = User::where('id', '!=', auth()->id())->get();

        // list message voi sender_id la id cua user_to cho auth 
        // messages_count: so tin nhan chua seen tu user_from
        $unreadIds = Message::select(\DB::raw('`user_from` as sender_id, count(`user_from`) as messages_count'))
            ->where('user_to', auth()->id())
            ->where('status', false)
            ->groupBy('user_from')
            ->get();

        // them truong unread cho moi contact
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });


        return response()->json($contacts);
    }


    // lay list messages da chon giua 2 nguoi
    public function getMessagesFor($id)
    {
        // danh dau tat ca tin nhan voi user_from da chon la da doc: status = true
        Message::where('user_from', $id)->where('user_to', auth()->id())->update(['status' => true]);

        // lay tat a cac tin nhan voi user_to = $id 
        $messages = Message::where(function($q) use ($id) {
            $q->where('user_from', auth()->id());
            $q->where('user_to', $id);
        })->orWhere(function($q) use ($id) {
            $q->where('user_from', $id);
            $q->where('user_to', auth()->id());
        })
        ->get();

        return response()->json($messages);
    }

    // gui tin nhan moi
    public function send(Request $request)
    {   
        if($request->conID) {
            $message = Message::create([
                'user_from' => auth()->id(),
                'user_to' => $request->contact_id,
                'msg' => $request->msg,
                'conversation_id' => $request->conID,
                'status' => 0
            ]);
        } else {
            // new conversation
            $conID_new = DB::table('conversation')->insertGetId([
                'user_one' => auth()->id(),
                'user_two' => $request->contact_id,
                'status' => 0
            ]);

            $message = Message::create([
                'user_from' => auth()->id(),
                'user_to' => $request->contact_id,
                'msg' => $request->msg,
                'conversation_id' => $conID_new,
                'status' => 0
            ]);

        }

        // phat sự kiện, gửi thông điệp đến người build sự kiện này
        // broadcast(new NewMessage($message));
        broadcast(new RedisEvent($message));
    	// event(
    	// 	$e = new RedisEvent($message)
    	// );

        return response()->json($message);
    }
}
