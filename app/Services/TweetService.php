<?php

namespace App\Services;
use App\Models\Tweet;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TweetService {
    public function getTweets() {
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
    }

    //自分のツイートかをチェックするメソッド
    public function checkOwnTweet(int $userId, int $tweetId): bool {
        $tweet = Tweet::where('id', $tweetId)->first();

        if(!$tweet) {
            return false;
        }

        //===はデータ型も含めた完全一致をしているかを調べる
        return $tweet->user_id === $userId;
    }

    public function countYesterdayTweets(): int 
    {
        return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())
            ->count();
    }

    public function saveTweet(int $userId, string $content, array $images) {
        // DBファサードを利用してトランザクションを作成している。
        // トランザクションは複数のSQL操作をコミットのまとまりとして同時に反映できる。
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet;
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();

            foreach ($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();
                $tweet->images()->attach($imageModel->id);
            }
        }); 
    }

    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use ($tweetId) {
            // 対象のつぶやきモデルを取得
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            // つぶやきに紐づいている画像を1件ずつ参照
            $tweet->images()->each(function ($image) use ($tweet){
                // 画像モデルからファイルパスを作成
                $filePath = 'public/images/'.$image->name;

                // 画像があれば削除
                if(Storage::exists($filePath)){
                    Storage::delete(($filePath));
                }
                // つぶやきと画像の紐付けを削除
                $tweet->images()->detach($image->id);
                // 画像モデル（レコード）を削除
                $image->delete();
            });
        });
    }
}