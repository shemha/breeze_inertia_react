<?php

// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Foundation/Application.php
use Illuminate\Foundation\Application;
// /reffect/breeze_inertia_react/vendor/laravel/framework/src/Illuminate/Support/Facades/Route.php
use Illuminate\Support\Facades\Route;
// /reffect/breeze_inertia_react/vendor/inertiajs/inertia-laravel/src/Inertia.php
use Inertia\Inertia;
// /blogsにアクセスするとブラウザ上にブログ一覧が表示されるためのルーティングを追加
// /reffect/breeze_inertia_react/app/Http/Controllers/BlogController.php
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// URLのルートが'/'の場合
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// URLのルートが'/dashboard'の場合
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// auth.phpを読み込む
require __DIR__.'/auth.php';

// /blogsにアクセスするとブラウザ上にブログ一覧が表示されるためのルーティングを追加
// /blogsにアクセスするとBlogControllerのindexメソッドを実行
Route::get('/blogs', [BlogController::class, 'index'])
    ->name('blog.index')
    // アクセス制限を設定
    // ログイン認証できたユーザーのみページ遷移
    ->middleware('auth');

// ダッシュボードページから/blogsにアクセスするリンクを設定
// 第二引数でDashboard.jsを読み込むコールバック関数を定義
Route::get('/dashboard', function () {
    // レンダリング先を指定
    // /reffect/breeze_inertia_react/resources/js/Pages/Dashboard.js
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');