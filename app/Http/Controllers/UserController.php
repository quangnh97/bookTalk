<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Log;

class UserController extends Controller
{
    // show all user
    public function index()
    {
        $users = DB::table('users')
            ->where('role','!=', 3)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info( 'delete ' . $id);
        DB::table('users')
            ->where('id', $id)
            ->delete();
        return response()->json([
            'success' => true,
        ]);
    }


}
