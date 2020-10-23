<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\User;
use DB;

class CommentsController extends Controller
{
	public function addComment(Request $request){
		$comment = $request->comment;
		$id = $request->id;

        $createComment= DB::table('comments')
        ->insert(['comment' =>$comment, 'user_id' => Auth::user()->id, 'post_id' => $id,
        'created_at' =>\Carbon\Carbon::now()->toDateTimeString()]);

        //$comments = comments::with('user')->get();

        if($createComment){
        return post::with('user','likes','comments.user')->orderBy('created_at','DESC')->get();
            //return comments::with('user')->get();
        }
    }

    public function deleteComment($id, Request $request){

    }

    public function updateComment($id, Request $request){

    }


}
