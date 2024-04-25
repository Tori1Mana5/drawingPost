<?php

namespace App\Mail;

use App\Models\UserToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPasswordCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    private $userAndUserToken;
    /**
     * コンストラクト
     *
     * @return void
     */
    public function __construct(
        UserToken $userAndUserToken
    )
    {
        $this->userAndUserToken = $userAndUserToken;
    }

    public function build()
    {
        return $this->from('hogehoge@example.com', 'おえかきしったー運営局')
            ->to($this->userAndUserToken->user->email)
            ->subject('パスワードの再設定が完了しました')
            ->view('mails.password_reset_complete_mail')
            ->with([
                'userName' => $this->userAndUserToken->user->username,
                'url' => route('user.login'),   // ログイン画面へのURL
            ]);
    }
}
