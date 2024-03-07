<?php

namespace App\Rules;

use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TokenExpirationTimeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * トークンの有効期限が切れていないかチェックする
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $now = Carbon::now();

        $userTokenRepository = app()->make(UserTokenRepositoryInterface::class);

        // userTokenテーブルからレコードを1件取得する
        $userToken = $userTokenRepository->getUserTokenAndUserFromToken($value);
        $expireTime = new Carbon($userToken->expire_at);

        // 現日時よりも前の日時であることを判定し、その結果を返す
        return $now->lte($expireTime);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '有効期限が過ぎています。パスワードリセットメールを再発行してください。';
    }
}
