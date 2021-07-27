<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
});

Route::group([
    'prefix' => 'email',
    'middleware' => 'signed'
], function () {
    Route::get('resend', [\App\Http\Controllers\VerifyEmailController::class, 'resend'])
        ->name('verification.resend');
    Route::get('verify/{id}/{hash}', [\App\Http\Controllers\VerifyEmailController::class, 'verify'])
        ->name('verification.verify');
});

Route::group([
    'prefix' => 'profile',
    'middleware' => 'api'
], function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'myProfile']);
    Route::put('update-avatar', [\App\Http\Controllers\ProfileController::class, 'updateAvatar']);
    Route::get('show/{id}', [\App\Http\Controllers\ProfileController::class, 'showAnyProfile']);
});

Route::group([
    'prefix' => 'post',
    'middleware' => 'api'
], function () {
    Route::get('/', [\App\Http\Controllers\PostController::class, 'allPost']);
    Route::get('/my-post', [\App\Http\Controllers\PostController::class, 'myPost']);
    Route::get('/post-without-comments', [\App\Http\Controllers\PostController::class, 'postWithoutComments']);
    Route::get('/most-view-posts', [\App\Http\Controllers\PostController::class, 'mostViewPosts']);
    Route::post('/', [\App\Http\Controllers\PostController::class, 'store']);
    Route::get('/{id}', [\App\Http\Controllers\PostController::class, 'show']);
    Route::put('/update/{id}', [\App\Http\Controllers\PostController::class, 'update']);
});

Route::group([
    'prefix' => 'comment',
    'middleware' => 'api'
], function () {
    Route::post('/create', [\App\Http\Controllers\CommentController::class, 'create']);
});

Route::group([
    'prefix' => 'tag',
    'middleware' => 'api'
], function () {
    Route::get('/search', [\App\Http\Controllers\TagController::class, 'search']);
});

