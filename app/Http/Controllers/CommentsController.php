<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use DB;
use Log;

class CommentsController extends Controller
{
	public function addComment(Request $request){
		$comment = $request->comment;
		$id = $request->id;
        Log::info( 'id ' . $request->id);
        Log::info( 'id ' . $comment);
        $createComment= DB::table('comments')
        ->insertGetId(['comment' =>$comment, 'user_id' => Auth::user()->id, 'book_id' => $id,
        'created_at' =>\Carbon\Carbon::now()->toDateTimeString()]);

        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.id',$createComment )
            ->select( 'comments.id','comments.comment','comments.user_id','users.name', 'users.pic')
            ->get();
//        $message = [
//            'id' => $request->userID,
//            'index' => $request->index,
//            'activity' => $activity,
//        ];
        Redis::set('name', 'Taylor1');
        $name = Redis::get('name');
        Log::info('name' . $name);
        Redis::publish('comment', json_encode($comments));


        return response()->json([
            'success' => true,
        ]);

    }

    public function comments(Request $request){
        Log::info( 'id ' . $request->id);
        $comments = DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.book_id', $request->id)
            ->select( 'comments.id','comments.comment','comments.user_id','users.name', 'users.pic')
            ->get();
        return response()->json([
            'success' => true,
            'comments' => $comments,
        ]);
    }

    public function deleteComment($id, Request $request){

    }

    public function updateComment($id, Request $request){

    }


}
