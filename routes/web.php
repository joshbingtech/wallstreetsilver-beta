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
    // manage articles and comments
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin/dashboard');
    Route::get('/articles', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin/articles');
    Route::get('/create-article', [App\Http\Controllers\Admin\ArticleController::class, 'createView'])->name('admin/create-article-view');
    Route::post('/create-article', [App\Http\Controllers\Admin\ArticleController::class, 'createArticle'])->name('admin/create-article');
    Route::get('/edit-article/{article_id}', [App\Http\Controllers\Admin\ArticleController::class, 'editView'])->name('admin/edit-article-view');
    Route::post('/edit-article', [App\Http\Controllers\Admin\ArticleController::class, 'editArticle'])->name('admin/edit-article');
    Route::post('/delete-article', [App\Http\Controllers\Admin\ArticleController::class, 'deleteArticle'])->name('admin/delete-article');
    Route::post('/delete-comment', [App\Http\Controllers\Admin\ArticleController::class, 'deleteComment'])->name('admin/delete-comment');
    Route::post('/restore-comment', [App\Http\Controllers\Admin\ArticleController::class, 'restoreComment'])->name('admin/restore-comment');

    //manage users
    Route::get('/manage-admins', [App\Http\Controllers\Admin\UserController::class, 'manageAdmins'])->name('admin/manage-admins');
    Route::get('/manage-journalists', [App\Http\Controllers\Admin\UserController::class, 'manageJournalists'])->name('admin/manage-journalists');
    Route::get('/manage-users', [App\Http\Controllers\Admin\UserController::class, 'manageUsers'])->name('admin/manage-users');
    Route::post('/create-admin', [App\Http\Controllers\Admin\UserController::class, 'createAdmin'])->name('admin/create-admin');
    Route::post('/create-journalist', [App\Http\Controllers\Admin\UserController::class, 'createJournalist'])->name('admin/create-journalist');
    Route::post('/create-user', [App\Http\Controllers\Admin\UserController::class, 'createUser'])->name('admin/create-user');
    Route::post('/lock-user', [App\Http\Controllers\Admin\UserController::class, 'lockUser'])->name('admin/lock-user');
    Route::post('/unlock-user', [App\Http\Controllers\Admin\UserController::class, 'unlockUser'])->name('admin/unlock-user');

    //manage settings
    Route::get('/manage-sns', [App\Http\Controllers\Admin\SettingsController::class, 'manageSNS'])->name('admin/manage-sns');
    Route::post('/add-sns', [App\Http\Controllers\Admin\SettingsController::class, 'addSNS'])->name('admin/add-sns');
    Route::post('/edit-sns', [App\Http\Controllers\Admin\SettingsController::class, 'editSNS'])->name('admin/edit-sns');
    Route::post('/delete-sns', [App\Http\Controllers\Admin\SettingsController::class, 'deleteSNS'])->name('admin/delete-sns');
    
    Route::get('/manage-supporters', [App\Http\Controllers\Admin\SettingsController::class, 'manageSupporters'])->name('admin/manage-supporters');
    Route::post('/add-supporter', [App\Http\Controllers\Admin\SettingsController::class, 'addSupporter'])->name('admin/add-supporter');
    Route::post('/edit-supporter', [App\Http\Controllers\Admin\SettingsController::class, 'editSupporter'])->name('admin/edit-supporter');
    Route::post('/delete-supporter', [App\Http\Controllers\Admin\SettingsController::class, 'deleteSupporter'])->name('admin/delete-supporter');
    Route::get('/manage-other-settings', [App\Http\Controllers\Admin\SettingsController::class, 'manageOtherSettings'])->name('admin/manage-other-settings');
});

// routes for journalists
Route::prefix('journalist')->middleware('auth')->group(function() {

});

// routes for users
Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('landing');
Route::get('/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::get('/news', [App\Http\Controllers\User\NewsController::class, 'index'])->name('news');
Route::get('/news/{article_id}', [App\Http\Controllers\User\NewsController::class, 'displayArticle'])->name('display-article');
Route::post('/comment', [App\Http\Controllers\User\CommentController::class, 'create'])->name('comment');
Route::post('/comment-like', [App\Http\Controllers\User\CommentController::class, 'like'])->name('comment-like');
Route::post('/comment-dislike', [App\Http\Controllers\User\CommentController::class, 'dislike'])->name('comment-dislike');

// routes for gold charts
Route::get('/charts/spot-gold', [App\Http\Controllers\User\ChartController::class, 'spotGold'])->name('charts/spot-gold');
Route::get('/charts/live-gold-price', [App\Http\Controllers\User\ChartController::class, 'liveGoldPrice'])->name('charts/live-gold-price');
Route::get('/charts/gold-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'goldPricePerOunce'])->name('charts/gold-price-per-ounce');
Route::get('/charts/gold-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'goldPricePerGram'])->name('charts/gold-price-per-gram');
Route::get('/charts/gold-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'goldPricePerKilo'])->name('charts/gold-price-per-kilo');
Route::get('/charts/gold-price-history', [App\Http\Controllers\User\ChartController::class, 'goldPriceHistory'])->name('charts/gold-price-history');
Route::get('/charts/gold-silver-ratio', [App\Http\Controllers\User\ChartController::class, 'goldSilverRatio'])->name('charts/gold-silver-ratio');

// routes for silver charts
Route::get('/charts/spot-silver', [App\Http\Controllers\User\ChartController::class, 'spotSilver'])->name('charts/spot-silver');
Route::get('/charts/live-silver-price', [App\Http\Controllers\User\ChartController::class, 'liveSilverPrice'])->name('charts/live-silver-price');
Route::get('/charts/silver-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'silverPricePerOunce'])->name('charts/silver-price-per-ounce');
Route::get('/charts/silver-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'silverPricePerGram'])->name('charts/silver-price-per-gram');
Route::get('/charts/silver-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'silverPricePerKilo'])->name('charts/silver-price-per-kilo');
Route::get('/charts/silver-price-history', [App\Http\Controllers\User\ChartController::class, 'silverPriceHistory'])->name('charts/silver-price-history');
Route::get('/charts/silver-gold-ratio', [App\Http\Controllers\User\ChartController::class, 'silverGoldRatio'])->name('charts/silver-gold-ratio');

// routes for platinum charts
Route::get('/charts/live-platinum-price', [App\Http\Controllers\User\ChartController::class, 'livePlatinumPrice'])->name('charts/live-platinum-price');
Route::get('/charts/platinum-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'platinumPricePerOunce'])->name('charts/platinum-price-per-ounce');
Route::get('/charts/platinum-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'platinumPricePerGram'])->name('charts/platinum-price-per-gram');
Route::get('/charts/platinum-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'platinumPricePerKilo'])->name('charts/platinum-price-per-kilo');
Route::get('/charts/platinum-price-history', [App\Http\Controllers\User\ChartController::class, 'platinumPriceHistory'])->name('charts/platinum-price-history');
Route::get('/charts/gold-platinum-ratio', [App\Http\Controllers\User\ChartController::class, 'goldPlatinumRatio'])->name('charts/gold-platinum-ratio');

// routes for palladium charts
Route::get('/charts/live-palladium-price', [App\Http\Controllers\User\ChartController::class, 'livePalladiumPrice'])->name('charts/live-palladium-price');
Route::get('/charts/palladium-price-per-ounce', [App\Http\Controllers\User\ChartController::class, 'palladiumPricePerOunce'])->name('charts/palladium-price-per-ounce');
Route::get('/charts/palladium-price-per-gram', [App\Http\Controllers\User\ChartController::class, 'palladiumPricePerGram'])->name('charts/palladium-price-per-gram');
Route::get('/charts/palladium-price-per-kilo', [App\Http\Controllers\User\ChartController::class, 'palladiumPricePerKilo'])->name('charts/palladium-price-per-kilo');
Route::get('/charts/palladium-price-history', [App\Http\Controllers\User\ChartController::class, 'palladiumPriceHistory'])->name('charts/palladium-price-history');
Route::get('/charts/gold-palladium-ratio', [App\Http\Controllers\User\ChartController::class, 'goldPalladiumRatio'])->name('charts/gold-palladium-ratio');

Route::get('/invitation/{token}', [App\Http\Controllers\Auth\InviteController::class, 'inviteView'])->name('invitation');
Route::post('/accept-invitation', [App\Http\Controllers\Auth\InviteController::class, 'acceptInvitation'])->name('accept-invitation');
