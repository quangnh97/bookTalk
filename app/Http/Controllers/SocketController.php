<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LRedis;


class SocketController extends Controller {
    public function sendMessage(Request $request){
        \Log::info('send Message');
        // dd($request->message);
        LRedis::publish('message', $request->message);
        // $redis = LRedis::connection();
        LRedis::set('nameeee', 'Taylor');
        // dd(LRedis::set('name', 'Taylor'));
        // $redis->publish('message',  $request->message );
        //  dd(LRedis::publish('test-channel', json_encode(['foo' => 'bar'])));
    }
}