<?php

namespace App\Repositories\Interfaces;

use App\Models\UserToken;

interface UserTokenRepositoryInterface
{
    /**
     * Userのパスワードリセット用のためのトークン発行
     * トークンが存在している場合は更新
     * 
     * @param int $userId
     * @return UserToken
     */
    public function updateOrCreateUserToken(int $userId): UserToken;

    /**
     * トークンに紐づいたUserTokenテーブルのレコードを1件取得
     *
     * @param string $token
     * @return UserToken
     */
    public function getUserTokenAndUserFromToken(string $token): UserToken;
}