<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\UpdateRequest;//FormRequestを読み込む
use App\Models\Tweet;//Eloquentモデルを取得
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, TweetService $tweetService)
    {
        if (!$tweetService->checkOwnTweet($request->user()->id, $request->id())) {
            throw new AccessDeniedHttpException();
        }

        //
        $tweet = Tweet::where('id', $request->id())->firstOrFail();//Requestのid()メソッドからidを取得して、Tweetモデルの中からidが一致するものを検索し、変数tweetに代入する
        $tweet->content = $request->tweet();//FormRequestのtweetメソッドを使用して、textareaから受け取ったものをtweetのcontentに挿入する
        $tweet->save();
        return redirect()
            ->route('tweet.update.index', ['tweetId' => $tweet->id])
            ->with('feedback.success', "つぶやきを編集しました");
    }
}
