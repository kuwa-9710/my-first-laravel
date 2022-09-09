<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_images', function (Blueprint $table) {
            $table->foreignId('tweet_id')->constrained('tweets')
                ->cascadeOnDelete();//tweetsテーブルからレコードが削除された場合には、tweet_imagesテーブルに紐付いたレコードも削除される
            $table->foreignId('image_id')->constrained('images')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweet_images');
    }
};
