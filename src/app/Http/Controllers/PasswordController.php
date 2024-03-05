<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendEmailRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use App\Mail\UserResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    private $userRepository;
    private $userTokenRepository;

    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';
    private const UPDATE_PASSWORD_SESSION_KEY = 'user_update_password_action';

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserTokenRepositoryInterface $userTokenRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->userTokenRepository = $userTokenRepository;
    }
    /**
     * パスワード再設定メール送信画面
     * 
     * @return View
     */
    public function emailFormResetPassword()
    {
        return view('user.reset_password.email_form');
    }

    /**
     * ユーザーのパスワード再設定メール送信処理
     *
     * @return RedirectResponse
     */
    public function sendEmailResetPassword(SendEmailRequest $request)
    {
        try {
            // フォームで送られたメールアドレスに紐づくユーザーを取得
            $user = $this->userRepository->findFromEmail($request->email);
    
            // ユーザーIDに紐づくトークンを作成する
            $userToken = $this->userTokenRepository->updateOrCreateUserToken($user->id);

            // 実行ログを記録
            Log::info(__METHOD__ . '...ID:' . $user->id . 'のユーザーにパスワード再設定用メールを送信します。');

            // メール送信
            Mail::send(new UserResetPasswordMail($user, $userToken));

            // メール送信実行後ログを記録
            Log::info(__METHOD__ . '...ID:' . $user->id . 'のユーザーにパスワードを再設定メールを送信しました。');
        } catch (Exception $e) {
            Log::error((__METHOD__ . '...ユーザーへのパスワード再設定用メール送信に失敗しました。 request_email = ' . $request->email . ' error_message = ' . $e));
            return redirect()->route('password_reset.email.form')
                            ->with('flash_message', '処理に失敗しました。時間を置いて再度お試しください。');
        }

        // メール送信完了画面への不正アクセスを防ぐためにセッションキーを設定する
        session()->put(self::MAIL_SENDED_SESSION_KEY, 'user_reset_password_send_email');

        return redirect()->route('password_reset.email.send_complete');
    }

    /**
     * パスワードリセットメール送信完了画面
     *
     * @return RedirectResponse|View
     */
    public function sendComplete()
    {
        // メール送信で設定したセッションキーが存在していない場合、リダイレクトする
        if (session()->pull(self::MAIL_SENDED_SESSION_KEY) !== 'user_reset_password_send_email') {
            return redirect()->route('password_reset.email.form')
                ->with('message', '不正なリクエストです。');
        }

        return view('user.reset_password.send_complete');
    }

    /**
     * ユーザーのパスワード再設定フォーム画面
     *
     * @param Request $request
     * @return void
     */
    public function edit(Request $request) 
    {
        // 署名の有効期限が切れていた場合は例外を投げる
        if (!$request->hasValidSignature()) {
            abort(403, 'URLの有効期限が過ぎたためエラーが発生しました。再度初めからやり直してください。');
        }

        // トークンを取得
        $resetToken = $request->reset_token;

        try {
            // トークンに紐づくUserTokenテーブルのレコードから一件取得する
            $userToken = $this->userTokenRepository->getUserTokenfromToken($resetToken);
        } catch (Exception $e) {
            Log::error(__METHOD__ . ' UserTokenの取得に失敗しました。 error_message = ' . $e);
            return redirect()->route('password_reset.email.form')
                ->with('flash_message', __('パスワードリセットメールに添付されたURlから遷移してください。'));
        }

        return view('user.reset_password.edit')
            ->with('userToken', $userToken);
    }

    /**
     * パスワード更新処理
     *
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function update(ResetPasswordRequest $request)
    {
        try {
            // トークンに紐づくuserTokenテーブル
            $userToken = $this->userTokenRepository->getUserTokenfromToken($request->reset_token);

            // 指定したユーザーIDを使用して紐づくパスワードを更新する
            $this->userRepository->updateUserPassword($request->password, $userToken->user_id);

            // パスワード更新ログを記録する
            Log::info(__METHOD__ . '...ID:' . $userToken->user_id . 'のユーザーのパスワードを更新しました。');
        } catch (Exception $e) {
            // 更新失敗ログを記録する
            Log::error(__METHOD__ . '...ユーザーのパスワードの更新に失敗しました。 ...error_message = ' . $e);

            // リダイレクトする
            return redirect()->route('password_reset.email.form')
                ->with('message', __('処理に失敗しました。時間をおいて再度お試しください。'));
        }
        // パスワードリセット完了画面の不正アクセス防止のためにセッションキーを設定
        $request->session()->put(self::UPDATE_PASSWORD_SESSION_KEY, 'user_update_password');
        
        return redirect()->route('password_reset.edited');
    }

    public function edited()
    {
        // パスワード更新処理で設定したセッションキーの値がない場合はパスワード入力フォームにリダイレクトする
        if (session()->pull(self::UPDATE_PASSWORD_SESSION_KEY) !== 'user_update_password') {
            return redirect()->route('password_reset.email.form')
                ->with('message', '不正なリクエストです。');
        }

        return view('user.reset_password.edited');
    }
}
