<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\isEmpty;

class ProfileController extends Controller
{
    /**
     * プロフィール画面を表示
     * @param string $userName
     * @return View
     */
    public function show(string $userName): View
    {
        $posts = Post::withWhereHas('user', function ($query) use ($userName) {
            $query->where('username', $userName);
        })->get();

        $profiles = Profile::withWhereHas('user', function ($query) use ($userName) {
            $query->where('username', $userName);
        })->get();

        // プロフィールのレコードがある場合は配列形式に変換、ない場合はnullで返す
        $profile = $profiles->isEmpty() ? null : $profiles->all()[0];

        return view('profile/show', ['posts' => $posts, 'profile' => $profile, 'userName' => $userName]);
    }

    /**
     * プロフィール登録画面を表示
     * @param string $userName
     * @return View
     */
    public function register(string $userName): View
    {
        if (!Gate::allows('register-profile', $userName)) {
            abort(403);
        }
        return view('profile/register', ['userName' => $userName]);
    }

    /**
     * 編集画面でプロフィールを新規で登録する処理
     * @param string $userName
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function storeComplete(string $userName, ProfileRequest $request): RedirectResponse
    {
        $body = $request->input('body.0');

        $profile_icon = null;
        $profile_background = null;

        // プロフィールアイコンとプロフィール背景がアップロードされている時にチェックする
        if ($request->hasFile('profile_image')) {
            $check_icon = $request->file('profile_image.0');
            $check_profile_background = $request->file('profile_image.1');

            // アイコンがアップロードされていることとアップロードが問題ないことをチェック
            if (!is_null($check_icon) && $check_icon->isValid()) {
                $profile_icon = $check_icon->store('public/profile/icon');
            }

            // プロフィール背景がアップロードされていることとアップロードが問題ないことをチェック
            if (!is_null($check_profile_background) && $check_profile_background->isValid()) {
                $profile_background = $check_profile_background->store('public/profile/background');
            }
        }

        $profile = new Profile([
            'profile' =>  $body,
            'profile_icon' => $profile_icon,
            'profile_background' => $profile_background,
        ]);

        // プロフィールを紐付けるためにUserからidを取得
        $userId = User::where('username', $userName)->value('id');
        $user = User::find($userId);

        // 指定したユーザーに紐づけてプロフィールを登録
        $user->profile()->save($profile);

        return redirect()->route('profile.show', ['userName' => $userName]);
    }

    /**
     * プロフィール編集画面を表示
     * @param string $userName
     * @return View
     */
    public function edit(string $userName)
    {
        // 他のユーザーのプロフィールを編集する場合は処理を終了する
        if (!Gate::allows('edit-profile', $userName)) {
            abort(403);
        }
        $profile = Profile::withWhereHas('user', function ($query) use ($userName) {
            $query->where('username', $userName);
        })->get()->all()[0];

        session()->flash('icon', $profile['profile_icon']);
        session()->flash('background', $profile['profile_background']);

        return view('profile/edit', ['userName' => $userName, 'profile' => $profile]);
    }

    public function editComplete(string $userName, ProfileRequest $request)
    {
        $body = $request->input('body.0');
        $userName = $request->input('body.1');

        // プロフィールを紐付けるためにUserからidを取得
        $userId = User::where('username', $userName)->value('id');

        $profile_icon = null;
        $profile_background = null;

        // プロフィールアイコンとプロフィール背景がアップロードされている時にチェックする
        if ($request->hasFile('profile_image')) {
            $check_icon = $request->file('profile_image.0');
            $check_profile_background = $request->file('profile_image.1');

            // プロフィールアイコンがアップロードされていない状態またはアップロードに問題がある場合は編集画面にリダイレクト
            if (is_null($check_icon) || !$check_icon->isValid()) {
               redirect()->route('profile.edit', ['userName' => $userName]);
            }

            // プロフィール背景がアップロードされていない状態またはアップロードに問題がある場合は編集画面にリダイレクト
            if (is_null($check_profile_background) || $check_profile_background->isValid()) {
                redirect()->route('profile.edit', ['userName' => $userName]);
            }

            // 編集前のアイコン画像ファイルがある場合は削除
            if (!is_null(session('icon'))) {
                Storage::delete(session('icon'));
            }

            // 編集前の背景画像ファイルがある場合は削除
            if (!is_null(session('background'))) {
                Storage::delete(session('background'));
            }

            $profile_icon = $check_icon->store('public/profile/icon');
            $profile_background = $check_profile_background->store('public/profile/background');
        }

        Profile::where('user_id', $userId)
            ->update([
                'profile' => $body,
                'profile_icon' => is_null($profile_icon) ? session('icon') : $profile_icon,
                'profile_background' => is_null($profile_background) ? session('background') : $profile_background,
            ]);

        User::where('user_id', $userId)
            ->update([
                ''
            ]);

        return redirect()->route('profile.show', ['userName' => $userName]);
    }
}
