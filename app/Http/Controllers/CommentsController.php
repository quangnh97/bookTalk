<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\User;
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
        ->insert(['comment' =>$comment, 'user_id' => Auth::user()->id, 'book_id' => $id,
        'created_at' =>\Carbon\Carbon::now()->toDateTimeString()]);

        //$comments = comments::with('user')->get();

        if($createComment){
        return post::with('user','likes','comments.user')->orderBy('created_at','DESC')->get();
            //return comments::with('user')->get();
        }
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
