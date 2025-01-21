<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use App\Http\Middleware\NotificationMiddleware;
use Illuminate\Support\Facades\Route;

// Route public using Indonesian, other using English.

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('/@{username}', [PageController::class, 'author'])->name('pages.author');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/search', [PageController::class, 'search'])->name('pages.search');
Route::get('/request-invitation', [PageController::class, 'requestInvitation'])->name('pages.request-invitation');
Route::post('/send-request-invitation', [PageController::class, 'sendRequestInvitation'])->name('pages.send-request-invitation');
Route::post('/subscribe', [PageController::class, 'subscribe'])->name('pages.subscribe');

// Route::middleware('auth')->prefix('dashboard')->controller(DashboardController::class)->group(function () {
//     Route::get('/', 'index')->name('dashboard');
// });

Route::middleware('auth', NotificationMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::resource('notifications', NotificationController::class);

    Route::resource('missions', MissionController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/verification', [ProfileController::class, 'verification'])->name('profile.verification');
    Route::get('/profile/rank', [ProfileController::class, 'rank'])->name('profile.rank');
    Route::get('/profile/bank-account', [ProfileController::class, 'bankAccount'])->name('profile.bank-account');

    Route::get('/articles/check-slug', [ArticleController::class, 'checkSlug']);
    Route::post('/articles/upload', [ArticleController::class, 'upload'])->name('articles.upload');
    Route::get('/articles/tags', [ArticleController::class, 'fetchTags'])->name('articles.tags');
    Route::get('/articles/{id}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::resource('articles', ArticleController::class)->except(['show']);

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::post('/earnings/calculate', [EarningController::class, 'calculate'])->name('earnings.calculate');
    Route::post('/earnings/withdraw', [EarningController::class, 'withdraw'])->name('earnings.withdraw');
    Route::resource('earnings', EarningController::class);

    Route::post('/users/{user}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');
});

Route::post('/articles/check-typo', [ArticleController::class, 'checkTypo']);
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/cari', [ArticleController::class, 'search'])->name('articles.search');

Route::get('/whatsapp/send-notification/{articleId}', [WhatsappController::class, 'sendNotification'])->name('whatsapp.send');

Route::get('/kategori/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tags/{tag}', [PageController::class, 'tagShow'])->name('pages.tags');

Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/validate-referral', [RegisteredUserController::class, 'validateReferral'])->name('validate.referral');
require __DIR__ . '/auth.php';
