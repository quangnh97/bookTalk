<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\user;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // search user
    public function search(Request $request){
        $qry = $request->qry;
        if($qry!=""){
            $users= DB::table('users')
            ->where('name', 'like', '%'. $qry . '%')
            ->get();

            return $users;
        }

    }
}
