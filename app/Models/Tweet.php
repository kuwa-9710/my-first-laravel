<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory; 

    //tweetモデルからUserモデルへの関連付け。
    public function user() {
        return $this->belongsTo(User::class);
    }

    // tweetモデルからTweetImageのPivotモデルを経由して、imageモデルを取得できるようになる
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tweet_images')
        ->using(TweetImage::class);
    }
}
