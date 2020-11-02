<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    // Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){

        Route::get('refresh', 'AuthController@refresh');
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');

    // posts
    Route::get('/posts', function () {
        return App\post::with('user','likes','comments.user')
        ->orderBy('created_at','DESC')
        ->get();
    });

    Route::post('addPost', 'PostsController@addPost');
    //delete post
    Route::get('/deletePost/{id}','PostsController@deletePost');
    //like post
    Route::get('/likePost/{id}','PostsController@likePost');
    // update post
    Route::post('updatePost/{id}', 'PostsController@updatePost');

    // category
    Route::resource('categories', CategoryController::class);
    Route::get('/booksInCategory','CategoryController@booksInCategory');
    Route::get('/allCategories','CategoryController@allCategories');

    // book
    Route::resource('book', BooksController::class);
    Route::get('/readOnline','BooksController@readOnline');


    //add comments
    Route::get('comments', 'CommentsController@comments');

    Route::post('addComment', 'CommentsController@addComment');
    //delete comments
    Route::post('deleteComment/{id}','CommentsController@deleteComment');
    //update commment
    Route::post('updateComment/{id}','CommentsController@updateComment');
    //save image
    Route::post('saveImg', 'PostsController@saveImg');

    Route::get('posts/{id}', function($id){
        $pData = App\post::where('id',$id)->get();
        return $pData[0]->content;
    });

    // xem profile user
    Route::get('/profile/{slug}', 'ProfileController@index');
    Route::get('/changePhoto', function() {
        return view('profile.pic');
    });
    Route::get('editProfile', 'ProfileController@editProfileForm');
    Route::post('/uploadPhoto', 'ProfileController@uploadPhoto');
    // update profile
    Route::post('/updateProfile','ProfileController@updateProfile');
    // search
    Route::post('search', 'HomeController@search');
    // friends
    Route::get('friends', 'ProfileController@friends');
    Route::get('/unfriend/{id}','ProfileController@unFriend' );
    Route::get('/getAllUsers', 'ProfileController@getAllUsers');
    Route::get('/checkFriend/{idUser}','ProfileController@checkFriend');
    Route::get('/addFriend/{id}', 'ProfileController@sendRequest');
    Route::get('/requests', 'ProfileController@requests');
    Route::get('/accept/{id}', 'ProfileController@accept');
    Route::get('/getInvitation','ProfileController@getInvitation');
    Route::get('requestRemove/{id}', 'ProfileController@requestRemove');
    Route::get('/notifications/{id}', 'ProfileController@notifications');

    //messages
        // messenger start
    Route::get('/getMessages','MessagesController@getMessages');
    Route::get('/getMessages/{id}', 'MessagesController@getDetailMessage');
    Route::get('newMessage','MessagesController@newMessage');
    Route::post('sendNewMessage', 'MessagesController@sendNewMessage');
    // Route::post('/sendMessage', 'MessagesController@sendMessage');

    //
    Route::get('/contacts', 'ContactsController@get');
    // lay ds tin nhan theo user_from
    Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
    // gui tin nhan moi
    Route::post('/conversation/send', 'ContactsController@send');

});

    // posts
    Route::get('/posts', function () {
        return App\post::with('user','likes','comments.user')
        ->orderBy('created_at','DESC')
        ->get();
    });

    Route::get('socket', 'SocketController@index');
    Route::post('sendmessage', 'SocketController@sendMessage');

    Route::get('/getDownload', 'BooksController@getDownload');

    Route::get('/categoryHome','CategoryController@categoryHome');
