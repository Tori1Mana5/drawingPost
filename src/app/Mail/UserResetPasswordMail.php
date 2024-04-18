<?php

namespace App\Mail;

use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class UserResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $userToken;

    /**
     * コンストラクト
     * 
     * @param User $user
     * @param UserToken $userToken
     */
    public function __construct(
        User $user,
        UserToken $userToken
    )
    {
        $this->user = $user;
        $this->userToken = $userToken;
    }

    public function build()
    {
        $tokenParam = ['reset_token' => $this->userToken->token];
        
        $now = Carbon::now();

        // URLの有効期限の時間を設定
        $expirationTime = $now->addHours(24);
        
        // 24時間後を期限とした署名付きURLを生成
        $url = URL::temporarySignedRoute('password_reset.edit', $expirationTime, $tokenParam);

        return $this->from('hogehoge@example.com', 'おえかきしったー運営局')
            ->to($this->user->email)
            ->subject('パスワードをリセットする')
            ->view('mails.password_reset_mail')
            ->with([
                'user' => $this->user,
                'url' => $url,
                'time' => $expirationTime,
            ]);
    }
}
