<?php 

namespace App\Repositories\Eloquents;

use App\Models\UserToken;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    private $userToken;

    public function __construct(UserToken $userToken) 
    {
        $this->userToken = $userToken;
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreateUserToken(int $userId): UserToken
    {
        $now = Carbon::now();
        
        // ハッシュ関数を使い、ユーザーIDをハッシュ化する
        $hashedToken = hash('sha256', $userId);

        // 該当のユーザーIDのレコードがある場合はトークンとトークンの有効時間を更新する
        // ない場合はレコードを新しく挿入する
        return $this->userToken->updateOrCreate(
            [
                'user_id' => $userId,
            ],
            [
                'token' => uniqid(rand(), $hashedToken),
                'expire_at' => $now->addHour(24)->toDateTimeString(),   // 24時間有効な時間を設定する
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function getUserTokenAndUserFromToken(string $token): UserToken
    {
        // トークンを使い、紐づいたユーザートークンとユーザー情報を取得
        return $this->userToken->with('user')->where('token', $token)->firstOrFail();
    }
}