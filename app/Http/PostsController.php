<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;
use App\comments;
use App\User;
use DB;

class PostsController extends Controller
{

  public function index(){
    $posts = DB::table('posts')->get();
    return view('posts',compact('posts'));
  }

  public function addPost(Request $request){
    dd($request);
    $content = $request->content;
    $createPost = DB::table('posts')
    ->insert(['content' =>$content, 'user_id' => Auth::user()->id,
    'status' =>0, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

    if($createPost){
      return post::with('user','likes','comments')
      ->orderBy('created_at','DESC')->get();
    }
  }

  public function deletePost($id){
    $deletePost = DB::table('posts')->where('id',$id)->delete();
    if($deletePost){
      return post::with('user','likes','comments')
      ->orderBy('created_at','DESC')->get();
    }
  }

  //
  public function updatePost($id, Request $request){
    $updatePost = DB::table('posts')->where('id',$id)
    ->update(['content' => $request->updatedContent,]);

    if($updatePost){
      return post::with('user','likes','comments')
      ->orderBy('created_at','DESC')->get();
    }
  }

  public function likePost($id){
    // $likePostAuth = DB::table('likes')->where('post_id',$id)->where('user_id', Auth::user()->id)->get();

    // $test = 1;
    // if(count($likePostAuth)) {
    //   $test = 0;
    // }
    // if($test) {
    //   $likePost = DB::table('likes')->insert([
    //     'post_id' => $id,
    //     'user_id' => Auth::user()->id,
    //     'created_at' =>\Carbon\Carbon::now()->toDateTimeString()
    //   ]);
    // }

    // return post::with('user','likes','comments')->orderBy('created_at','DESC')->get();
  }


  public function savePost(Request $request){
    $img = $request->get('image');

    // loai bo phan phu
    $exploded = explode(",",$img);

    // extention : xem image la dang anh duoi gi?
    if(str_contains($exploded[0], 'gif')){
      $ext = 'gif';
    }else if(str_contains($exploded[0], 'png')){
      $ext = 'png';
    }else{
      $ext = 'jpg';
    }

    // decode: convert sang binary de send in network an eazy way
    $decode = base64_decode($exploded[1]);

    // duong dan cho thu muc image
    $filename = str_random() . "." . $ext;

    // upload image vao duong dan
    $path = public_path() . "/img/" . $filename;

    if(file_put_contents($path,$decode)){
      // echo "file uploaded" . $filename;
      $content = $request->content;

      $createPost = DB::table('posts')
      ->insert(['content' =>$content, 'user_id' => Auth::user()->id,'image' => $filename,
      'status' =>0, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

      if($createPost){
        return post::with('user','likes','comments')->orderBy('created_at','DESC')->get();
      }

    }
  }

  // save image when up post
  public function saveImg(Request $request){
    $img = $request->get('image');

    // remove extra parts
    $exploded = explode(",",$img);
    // extention
    if(str_contains($exploded[0], 'gif')){
      $ext = 'gif';
    }else if(str_contains($exploded[0], 'png')){
      $ext = 'png';
    }else{
      $ext = 'jpg';
    }

    // decode
    $decode = base64_decode($exploded[1]);

    $filename = str_random() . "." . $ext;

    //path of your local folder
    $path = public_path() . "/images/" . $filename;

    //upload image to your path

    if(file_put_contents($path,$decode)){
    // echo "file uploaded" . $filename;
    $content = $request->content;
    $createPost = DB::table('posts')
      ->insert(['content' =>$content, 'user_id' => Auth::user()->id,'image' => $filename,
     'status' =>0, 'created_at' =>\Carbon\Carbon::now()->toDateTimeString(), 'updated_at' => \Carbon\Carbon::now()->toDateTimeString() ]);

    if($createPost){
      return post::with('user','likes','comments')->orderBy('created_at','DESC')->get();
    }

   }


}
}
