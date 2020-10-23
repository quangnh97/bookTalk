<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
  // create relaion users and posts
  public function user(){
    return $this->belongsTo(User::class);
  }

  public function likes(){
    return $this->hasMany(likes::class,'post_id');
  }

	public function comments(){
    return $this->hasMany(comments::class,'post_id');
  }

  public function files() {
    return $this->hasMany(Files::class,'post_id');
  }

}
