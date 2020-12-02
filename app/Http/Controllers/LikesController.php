<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\User;
use DB;
use Log;

class LikesController extends Controller
{
	public function likeBook(Request $request){

        $idBook = $request->idBook;
        $idUser = $request->idUser;

        $like = DB::table('likes')
        ->insert(['book_id' =>$idBook, 'user_id' => $idUser,
        'created_at' =>\Carbon\Carbon::now()->toDateTimeString()]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function checkLike(Request $request){

        $idBook = $request->idBook;
        $idUser = $request->idUser;

        $like = DB::table('likes')
                ->where('book_id',$idBook )
                ->where('user_id',$idUser )
                ->count();
        return response()->json([
            'success' => true,
            'count' => $like
        ]);
    }

    public function getLike(Request $request){
        Log::info( 'id ' . $request->id);
        $total = DB::table('likes')
            ->where('likes.book_id', $request->id)
            ->count();
        return response()->json([
            'success' => true,
            'total' => $total,
        ]);
    }

    public function deleteLike($id, Request $request){

    }

    public function updateLike($id, Request $request){

    }


}
