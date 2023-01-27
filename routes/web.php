<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// routes for authentication

Auth::routes();

// routes for admins
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin/dashboard');
    Route::get('/articles', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin/articles');
    Route::get('/create-article', [App\Http\Controllers\Admin\ArticleController::class, 'createView'])->name('admin/create-article-view');
    Route::post('/create-article', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin/create-article');
    Route::get('/edit-article/{article_id}', [App\Http\Controllers\Admin\ArticleController::class, 'editView'])->name('admin/edit-article-view');
    Route::post('/edit-article', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('admin/edit-article');
    Route::post('/delete-article', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('admin/delete-article');

    Route::get('/manage-admins', [App\Http\Controllers\Admin\UserController::class, 'manageAdmins'])->name('admin/manage-admins');
    Route::get('/manage-journalists', [App\Http\Controllers\Admin\UserController::class, 'manageJournalists'])->name('admin/manage-journalists');
    Route::get('/manage-users', [App\Http\Controllers\Admin\UserController::class, 'manageUsers'])->name('admin/manage-users');
    Route::post('/create-admin', [App\Http\Controllers\Admin\UserController::class, 'createAdmin'])->name('admin/create-admin');
    Route::post('/create-journalist', [App\Http\Controllers\Admin\UserController::class, 'createJournalist'])->name('admin/create-journalist');
    Route::post('/create-user', [App\Http\Controllers\Admin\UserController::class, 'createUser'])->name('admin/create-user');
    Route::post('/lock-user', [App\Http\Controllers\Admin\UserController::class, 'lockUser'])->name('admin/lock-user');
    Route::post('/unlock-user', [App\Http\Controllers\Admin\UserController::class, 'unlockUser'])->name('admin/unlock-user');
});

// routes for journalists
Route::prefix('journalist')->middleware('auth')->group(function() {

});

// routes for users
Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('landing');
Route::get('/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\User\NewsController::class, 'index'])->name('news');
Route::get('/news/{article_id}', [App\Http\Controllers\User\NewsController::class, 'displayArticle'])->name('display-article');
Route::post('/comment', [App\Http\Controllers\User\CommentController::class, 'create'])->middleware('auth')->name('comment');

// routes for charts
Route::get('/charts/spot-gold', [App\Http\Controllers\User\ChartController::class, 'spotGold'])->name('charts/spot-gold');
Route::get('/charts/live-gold-price', [App\Http\Controllers\User\ChartController::class, 'liveGoldPrice'])->name('charts/live-gold-price');
Route::get('/charts/gold-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'goldPricePerOunce'])->name('charts/gold-price-per-ounce');
Route::get('/charts/gold-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'goldPricePerGram'])->name('charts/gold-price-per-gram');
Route::get('/charts/gold-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'goldPricePerKilo'])->name('charts/gold-price-per-kilo');
Route::get('/charts/gold-price-history', [App\Http\Controllers\User\ChartController::class, 'goldPriceHistory'])->name('charts/gold-price-history');
Route::get('/charts/gold-silver-ratio', [App\Http\Controllers\User\ChartController::class, 'goldSilverRatio'])->name('charts/gold-silver-ratio');

Route::get('/charts/spot-silver', [App\Http\Controllers\User\ChartController::class, 'spotSilver'])->name('charts/spot-silver');
Route::get('/charts/live-silver-price', [App\Http\Controllers\User\ChartController::class, 'liveSilverPrice'])->name('charts/live-silver-price');
Route::get('/charts/silver-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'silverPricePerOunce'])->name('charts/silver-price-per-ounce');
Route::get('/charts/silver-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'silverPricePerGram'])->name('charts/silver-price-per-gram');
Route::get('/charts/silver-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'silverPricePerKilo'])->name('charts/silver-price-per-kilo');
Route::get('/charts/silver-price-history', [App\Http\Controllers\User\ChartController::class, 'silverPriceHistory'])->name('charts/silver-price-history');
Route::get('/charts/silver-gold-ratio', [App\Http\Controllers\User\ChartController::class, 'silverGoldRatio'])->name('charts/silver-gold-ratio');

Route::get('/invitation/{token}', [App\Http\Controllers\Auth\InviteController::class, 'inviteView'])->name('invitation');
Route::post('/accept-invitation', [App\Http\Controllers\Auth\InviteController::class, 'acceptInvitation'])->name('accept-invitation');
