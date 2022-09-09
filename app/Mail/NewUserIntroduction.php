<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

//implements以下を書く
// メールクラスにShouldQueueインターフェイスを実装することで、Queueするという印になる
class NewUserIntroduction extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = '新しいユーザーが追加されました。';
    public User $toUser;
    public User $newUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $toUser, User $newUser)
    {
        $this->toUser = $toUser;
        $this->newUser = $newUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Markdown形式のviewを渡すときはそのことを明示する必要があるため、markdownに変更する
        return $this->markdown('email.new_user_introduction');
    }
}
