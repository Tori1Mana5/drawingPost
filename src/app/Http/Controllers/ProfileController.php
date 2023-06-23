<?php

namespace App\Http\Controllers;
use App\Http\Requests\registerProfileRequest;
use App\Models\Post;
use App\Models\Profile;
use App\Http\Requests\EditProfileRequest;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;

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
     * @param RegisterProfileRequest $request
     * @return RedirectResponse
     */
    public function registerComplete(string $userName, RegisterProfileRequest $request): RedirectResponse
    {
        $profileData = [
            'profile' => $request->input('body.0')
        ];

        // プロフィールアイコンがアップロードされている時にチェックする
        if ($request->hasFile('profile_image.0')) {
            // プロフィールアイコンのアップロードに問題がある場合は編集画面にリダイレクト
            if (!$request->file('profile_image.0')->isValid()) {
                redirect()->route('profile.store', ['userName' => $userName]);
            }

            // プロフィール更新用の連想配列にアイコン画像のパスとを追加
            $profileData['profile_icon'] = $request->file('profile_image.0')->store('public');
        }

        // プロフィール背景がアップロードされている時にチェックする
        if ($request->hasFile('profile_image.1')) {
            // プロフィール背景のアップロードに問題がある場合は編集画面にリダイレクト
            if (!$request->file('profile_image.1')->isValid()) {
                redirect()->route('profile.store', ['userName' => $userName]);
            }

            // プロフィール更新用の連想配列にアイコン画像のパスと背景画像のバスを追加
            $profileData['profile_background'] = $request->file('profile_image.1')->store('public');
        }

        $profile = new Profile($profileData);

        // プロフィールを紐付けるためにUserからidを取得
        $userId = Auth::id();
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

    public function editComplete(string $userName, EditProfileRequest $request)
    {
        // プロフィールを変更するために連想配列をセット
        $profileData = [
            'profile' => $request->input('body.0'),
        ];

        // ニックネームを変更するために連想配列をセット
        $userData = [
            'display_name' => $request->input('body.1')
        ];

        // プロフィールアイコンがアップロードされている時にチェックする
        if ($request->hasFile('profile_image.0')) {
            // プロフィールアイコンのアップロードに問題がある場合は編集画面にリダイレクト
            if (!$request->file('profile_image.0')->isValid()) {
                redirect()->route('profile.edit', ['userName' => $userName]);
            }

            // 編集前のアイコン画像ファイルがある場合は削除
            if (!is_null(session('icon'))) {
                Storage::delete(session('icon'));
            }

            // プロフィール更新用の連想配列にアイコン画像のパスとを追加
            $profileData['profile_icon'] = $request->file('profile_image.0')->store('public');
        }

        // プロフィール背景がアップロードされている時にチェックする
        if ($request->hasFile('profile_image.1')) {
            // プロフィール背景のアップロードに問題がある場合は編集画面にリダイレクト
            if (!$request->file('profile_image.1')->isValid()) {
                redirect()->route('profile.edit', ['userName' => $userName]);
            }

            // 編集前の背景画像ファイルがある場合は削除
            if (!is_null(session('background'))) {
                Storage::delete(session('background'));
            }

            // プロフィール更新用の連想配列にアイコン画像のパスと背景画像のバスを追加
            $profileData['profile_background'] = $request->file('profile_image.1')->store('public');
        }

        // 更新対象のユーザーを指定するためにログインユーザーのidを取得
        $userId = Auth::id();
        Profile::where('user_id', $userId)
            ->update($profileData);

        User::where('id', $userId)
            ->update($userData);

        return redirect()->route('profile.show', ['userName' => $userName]);
    }
}
