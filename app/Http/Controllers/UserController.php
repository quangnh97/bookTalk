<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    // show all user
    public function index()
    {
        $users = DB::table('users')
            ->select( 'id','name','email','role')
            ->paginate(12);

        return response()->json(
            [
                'status' => 'success',
                'users' => $users
            ], 200);
    }

    // show 1 nguoi dung
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 'success',
                'user' => $user->toArray()
            ], 200);
    }


}
