<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', [\App\Http\Controllers\Sample\IndexController::class, 'show']);

Route::get('/sample/{id}', [\App\Http\Controllers\Sample\IndexController::class, 'showId']);

//if you use singleActionController, you don't need method name.
Route::get('/tweet', \App\Http\Controllers\Tweet\IndexController::class)
->name('tweet.index');

Route::middleware('auth')->group(function () {

    Route::post('/tweet/create', \App\Http\Controllers\Tweet\CreateController::class)
    //以下のmiddlewareを追加することで、ログインユーザーにしか見えないようにできる。
    // ->middleware('auth') middllewareで囲んだため必要なくなる
    ->name('tweet.create');//ツイートを作成する
    
    Route::get('tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\IndexController::class)
    ->name('tweet.update.index')//ツイートを編集する
    ->where('tweetId', '[0-9]+');//整数のみしか受け付けなくなり、それ以外は404エラーとなる
    
    Route::put('tweet/update/{tweetId}', \App\Http\Controllers\Tweet\Update\PutController::class)
    ->name('tweet.update.put')//ツイートを更新する
    ->where('tweetId', '[0-9]+');
    
    Route::delete('tweet/delete/{tweetId}', \App\Http\Controllers\Tweet\DeleteController::class)
    ->name('tweet.delete')
    ->where('tweetId', '[0-9]+');

});


//laravel breezeをインストールすると、以下のコードが追加される
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
