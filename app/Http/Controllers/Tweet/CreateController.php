<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Services\TweetService;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //サービスコンテナを利用している↓
    public function __invoke(CreateRequest $request, TweetService $tweetService)
    {
        // $tweet = new Tweet;
        // $tweet->user_id = $request->userId();//ここでユーザーIdを保存
        // $tweet->content = $request->tweet(); //RequestFormクラスに追加したtweetメソッドを利用してデータを取得する
        // $tweet->save(); //Tweetモデルのsave()メソッドを呼び出し、データベースに保存することができる

        $tweetService->saveTweet(
            $request->userId(),
            $request->tweet(),
            $request->images()
        );

        return redirect()->route('tweet.index'); //redirectヘルパーを利用して、元の画面に戻す
    }
}
