<?php

// /reffect/breeze_inertia_react/app/Http/Controllers/Auth/
namespace App\Http\Controllers\Auth;

// /reffect/breeze_inertia_react/app/Http/Controllers/Auth/ConfirmablePasswordController.php
use App\Http\Controllers\Controller;
// /reffect/breeze_inertia_react/app/Http/Requests/Auth/LoginRequest.php
use App\Http\Requests\Auth\LoginRequest;
// /reffect/breeze_inertia_react/app/Providers/RouteServiceProvider.php
use App\Providers\RouteServiceProvider;
// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Http/Request.php
use Illuminate\Http\Request;
// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Support/Facades/Auth.php
use Illuminate\Support\Facades\Auth;
// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Support/Facades/Route.php
use Illuminate\Support\Facades\Route;
// /reffect/breeze_inertia_react/vendor/inertiajs/inertia-laravel/src/Inertia.php
use Inertia\Inertia;

// 認証セッションの制御に関するクラス
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    // ログインユーザー情報を作成
    public function create()
    {
        // レンダリング先は"/reffect/breeze_inertia_react/resources/js/Pages/Auth/Login.js"を指定
        return Inertia::render('Auth/Login', [
            // PropsオブジェクトのcanResetPasswordとstatusの情報として連想配列で作成
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // Login.jsのsubmit関数によってログイン情報を取得してRouteServiceProvider::HOMEで指定されたページ(dashboard)へリダイレクト
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // ログイン情報を削除してindexへリダイレクト
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
