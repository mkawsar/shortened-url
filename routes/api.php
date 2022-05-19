<?php

use App\Http\Controllers\ShortLinkController;
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

Route::prefix('api/v1')->group(function () {
    Route::name('short.link')->group(function () {
        Route::get('short/link/list', [ShortLinkController::class, 'index'])->name('list');
        Route::post('short/link/create', [ShortLinkController::class, 'store'])->name('store');
        Route::get('get/{code}/shorten/link', [ShortLinkController::class, 'shortenLink'])->name('shorten');
    });
});

Route::get('/redirect/{code}', [ShortLinkController::class, 'redirect']);
