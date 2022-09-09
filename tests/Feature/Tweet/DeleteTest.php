<?php

namespace Tests\Feature\Tweet;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tweet;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_successed()
    {
        $user = User::factory()->create(); // ユーザーを作成

        $tweet = Tweet::factory()->create(['user_id' => $user->id]); // つぶやきを作成

        $this->actingAs($user); // 指定したユーザーでログインした状態にする

        $response = $this->delete('/tweet/delete/' . $tweet->id); // 作成したつぶやきIDを指定

        $response->assertRedirect('/tweet');
    }
}