<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService; //TweetServiceクラスに依存している状態
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //外部から依存性の注入を行う際の記述を追加
    //これを追加することによって＄tweetServiceのインスタンス化のコードが不要になる
    public function __invoke(Request $request, TweetService $tweetService)
    {
        // ツイートを全て取得する場合は以下のコードを利用する
        // $tweets = Tweet::all();

        // ツイートを作成日で並び替えたい場合は以下のコードを利用して、変数＄tweetsに対象のTweetモデルを代入する
        // $tweets = Tweet::orderBy('created_at', 'DESC')->get();
        
        //サービスコンテナを使用する場合は以下のコードになる
        // $tweetService = new TweetService(); //TweetServiceのインスタンスを作成する
        $tweets = $tweetService->getTweets(); //つぶやきの一覧を取得

        //結果をviewに返してあげる
        return view('tweet.index')
            ->with('tweets', $tweets);
    }
}
