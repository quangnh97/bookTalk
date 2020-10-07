<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


//Xác thực khi subcribe vào kênh Private
Broadcast::channel('messages.{id}', function ($user, $id) {
    // dd($user->id, $id);
    // return $user->id === (int) $id;
    return true;
});

//
Broadcast::channel('NewRequestFriend.{id}',function($user, $id) {
    // return true;
    return $user->id === (int) $id;
});

