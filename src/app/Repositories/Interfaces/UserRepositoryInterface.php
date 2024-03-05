<?php

namespace App\Repositories\Interfaces;

use app\Models\User;

interface UserRepositoryInterface
{
    /**
     * 引数で渡されたメールアドレスを持つユーザーを取得する
     * 
     * @param string $email
     * @return User
     */
    public function findFromEmail(string $email): User;

    /**
     * 引数に渡されたIDのユーザーのパスワードを更新する
     */
    public function updateUserPassword(string $password, int $id): void;
}