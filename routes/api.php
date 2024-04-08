<?php

use App\Http\Controllers\Api\AuthorizationsController;
use App\Http\Controllers\Api\CaptchaController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\GoogleOauth2;
use App\Http\Controllers\Api\ImagesController;
use App\Http\Controllers\Api\LinksController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\RepliesController;
use App\Http\Controllers\Api\SocialiteLogin;
use App\Http\Controllers\Api\TopicsController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function() {

    // 游客可以访问的接口
    Route::get('socialite/redirect-url/{company}/{serialNumber}', [SocialiteLogin::class, 'redirectUrl']);
    Route::get('socialite/token/{company}', [SocialiteLogin::class, 'token']);

    Route::get('auth/redirect', function () {
        Socialite::driver('google')->redirect();
    });

    Route::get('auth/callback', function () {
        $user = Socialite::driver('github')->user();
        echo $user->getEmail();
    });

    Route::get('google/index', [GoogleOauth2::class, 'index']);
    Route::get('google/callback', [GoogleOauth2::class, 'callback']);

    Route::middleware('throttle:' . config('api.rate_limits.sign'))->group(function () {
            // 用户注册
            Route::post('users', [UsersController::class, 'store'])->name('users.store');
            // 图片验证码
            Route::post('captcha', [CaptchaController::class, 'store'])->name('captcha.store');
        });

    // 登录
    Route::post('authorizations', [AuthorizationsController::class, 'store'])->name('authorizations.store');

    Route::apiResource('categories', CategoriesController::class)->only('index');

    // 某个用户发布的话题
    Route::get('users/{user}/topics', [TopicsController::class, 'userIndex'])->name('users.topics.index');

    // 某个用户的详情
    Route::get('users/{user}', [UsersController::class, 'show'])->name('users.show');
    // 话题列表，详情
    Route::apiResource('topics', TopicsController::class)->only(['index', 'show']);
    // 话题回复列表
    Route::apiResource('topics.replies', RepliesController::class)->only([
        'index',
    ]);
    // 某个用户的回复列表
    Route::get('users/{user}/replies', [RepliesController::class, 'userIndex'])->name('users.replies.index');
    // 资源推荐
    Route::apiResource('links', LinksController::class)->only(['index']);
    // 活跃用户
    Route::get('actived/users', [UsersController::class, 'activeIndex'])->name('active.users.index');

    // 登录后可以访问的接口
    Route::middleware('auth:sanctum')->group(function() {
        // 当前登录用户信息
        Route::get('user', [UsersController::class, 'me'])->name('user.show');

        // 编辑登录用户信息
        Route::patch('user', [UsersController::class, 'update'])->name('user.update');
        // 上传图片
        Route::post('images', [ImagesController::class, 'store'])->name('images.store');

        Route::apiResource('topics', TopicsController::class)->only([
            'store', 'update', 'destroy'
        ]);

        // 发布, 删除回复
        Route::apiResource('topics.replies', RepliesController::class)->only([
            'store', 'destroy'
        ]);
        // 通知列表
        Route::apiResource('notifications', NotificationsController::class)->only([
            'index'
        ]);

        // 通知统计
        Route::get('notifications/stats', [NotificationsController::class, 'stats'])->name('notifications.stats');

        // 标记消息通知为已读
        Route::patch('user/read/notifications', [NotificationsController::class, 'read'])->name('user.notifications.read');

        // 当前登录用户权限
        Route::get('user/permissions', [PermissionsController::class, 'index'])->name('user.permissions.index');
    });

});
