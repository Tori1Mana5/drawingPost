<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isLogin', function () {
            return Auth::check();
        });

        Gate::define('edit-profile', function (User $user, $username) {
            $profileCollection = Profile::where('user_id', $user->id)->get();
            // プロフィールが存在している状態であることとユーザーとURLに含まれるusernameは同じかの判定結果を返す
            return !$profileCollection->isEmpty() && $user->username === $username;
        });

        Gate::define('register-profile', function (User $user, $username) {
            $profileCollection = Profile::where('user_id', $user->id)->get();
            // プロフィールが存在していない状態であることとユーザーとURLに含まれるusernameは同じかの判定結果を返す
            return $profileCollection->isEmpty() && $user->username === $username;
        });
    }
}
