<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\RefreshController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Note\CreateNoteController;
use App\Http\Controllers\Note\DeleteNoteController;
use App\Http\Controllers\Note\ReadNoteController;
use App\Http\Controllers\Note\UpdateNoteController;
use App\Http\Controllers\Tag\CreateTagController;
use App\Http\Controllers\Tag\DeleteTagController;
use App\Http\Controllers\Tag\ReadTagByIdController;
use App\Http\Controllers\Tag\ReadTagController;
use App\Http\Controllers\Tag\UpdateTagController;
use Illuminate\Support\Facades\Route;

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
//Auth
Route::post('/auth/register', RegisterController::class);
Route::get('/email/verify/{id}/{hash}', EmailVerifyController::class)
    ->middleware(['signed'])
    ->name('verification.verify');
Route::group(['middleware' => 'api', 'prefix' => 'auth'], static function () {
    Route::post('login', LoginController::class);
    Route::post('logout', LogoutController::class);
    Route::post('refresh', RefreshController::class);
    Route::post('me', MeController::class);
});

//notes
Route::group(['middleware' => 'auth:api'], static function () {
    Route::post('note', CreateNoteController::class);
    Route::get('notes', ReadNoteController::class);
    Route::put('note/{note}', UpdateNoteController::class)->middleware('check.note.owner');
    Route::delete('note/{note}', DeleteNoteController::class)->middleware('check.note.owner');
});

//tags
Route::group(['middleware' => 'auth:api'], static function () {
    Route::post('tag', CreateTagController::class);
    Route::get('tags', ReadTagController::class);
    Route::get('tag/{id}', ReadTagByIdController::class);
    Route::put('tag/{id}', UpdateTagController::class);
    Route::delete('tag/{id}', DeleteTagController::class);
});
