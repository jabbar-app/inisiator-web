<?php

use App\Http\Controllers\ArticleCommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleReactionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DareMessageController;
use App\Http\Controllers\DareQuestionController;
use App\Http\Controllers\DareQuizController;
use App\Http\Controllers\DareReactionController;
use App\Http\Controllers\DareResponseController;
use App\Http\Controllers\DareTemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhatsappController;
use App\Http\Middleware\NotificationMiddleware;
use App\Models\DareQuiz;
use Illuminate\Support\Facades\Route;

// Route public using Indonesian, other using English.

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::get('/landing', [PageController::class, 'landing'])->name('pages.landing');
Route::get('/game', [PageController::class, 'game'])->name('pages.game');
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
    Route::patch('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/verification', [ProfileController::class, 'verification'])->name('profile.verification');
    Route::get('/profile/rank', [ProfileController::class, 'rank'])->name('profile.rank');
    Route::get('/profile/bank-account', [ProfileController::class, 'bankAccount'])->name('profile.bank-account');

    Route::get('/articles/check-slug', [ArticleController::class, 'checkSlug']);
    Route::post('/articles/upload', [ArticleController::class, 'upload'])->name('articles.upload');
    Route::get('/articles/tags', [ArticleController::class, 'fetchTags'])->name('articles.tags');
    Route::get('/articles/{article}/to-approve', [ArticleController::class, 'toApprove'])->name('articles.to-approve');
    Route::post('/articles/{article}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('/articles/{article}/mark-read', [ArticleController::class, 'markRead']);

    Route::post('/article/comments', [ArticleCommentController::class, 'store'])->name('article-comments.store');
    Route::get('/article/{article}/comments', [ArticleCommentController::class, 'loadMoreComments']);
    Route::post('/article/reactions', [ArticleReactionController::class, 'store'])->name('article-reactions.store');

    Route::resource('articles', ArticleController::class)->except(['show']);

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::post('/earnings/calculate', [EarningController::class, 'calculate'])->name('earnings.calculate');
    Route::post('/earnings/withdraw', [EarningController::class, 'withdraw'])->name('earnings.withdraw');
    Route::post('/earnings/check-in', [EarningController::class, 'checkIn'])->name('check-in');
    Route::resource('earnings', EarningController::class);

    Route::post('/users/{user}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');
});

Route::post('/articles/check-typo', [ArticleController::class, 'checkTypo']);
Route::get('/read/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{article}/clap', [ArticleController::class, 'clap'])->name('articles.clap');
Route::get('/cari', [ArticleController::class, 'search'])->name('articles.search');

Route::get('/whatsapp/send-notification/{articleId}', [WhatsappController::class, 'sendNotification'])->name('whatsapp.send');

Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tags/{tag}', [PageController::class, 'tagShow'])->name('pages.tags');

Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/validate-referral', [RegisteredUserController::class, 'validateReferral'])->name('validate.referral');

Route::prefix('play')->group(function () {
    // 1. Create Quiz
    Route::get('dare/create/{whatsapp?}', [DareQuizController::class, 'create'])->name('play.dare.create');
    Route::get('dare/store', [DareQuizController::class, 'store'])->name('play.dare.store');
    Route::put('dare/{id}/update-song', [DareQuizController::class, 'updateSong'])->name('quiz.updateSong');
    Route::post('register-whatsapp', [RegisteredUserController::class, 'registerWhatsapp'])->name('register.whatsapp');
    Route::get('validate-whatsapp/{whatsapp}', [RegisteredUserController::class, 'validateWhatsapp'])->name('validate.whatsapp');
    Route::post('verify-whatsapp/{whatsapp}', [RegisteredUserController::class, 'verifyWhatsapp'])->name('verify.whatsapp');
    Route::post('register-update', [RegisteredUserController::class, 'registerUpdate'])->name('register.update');
    // 2. Create Questions for Quiz
    Route::resource('dare/templates', DareTemplateController::class)->except(['show']);
    Route::get('dare/questions/create/{quiz_id}', [DareQuestionController::class, 'create'])->name('play.dare.add-questions');
    Route::get('dare/questions/change/{quiz_id}', [DareQuestionController::class, 'changeQuestion'])->name('questions.change');
    Route::resource('dare/questions', DareQuestionController::class)->except(['create']);
    // 3. Lobby Quiz
    Route::get('dare/{slug}', [DareQuizController::class, 'show'])->name('play.dare');
    // 4. Play Quiz
    // routes/web.php
    Route::get('dare/{slug}/start', [DareResponseController::class, 'start'])->name('play.dare.start');
    Route::post('dare/{slug}/start', [DareResponseController::class, 'storeName'])->name('play.dare.storeName');
    Route::get('dare/{slug}/create', [DareResponseController::class, 'create'])->name('dare-responses.create');
    Route::resource('dare-responses', DareResponseController::class)->except(['show', 'create']);

    Route::get('/quizzes/{quizId}/messages/create', [DareMessageController::class, 'create'])->name('dare-messages.create');
    Route::post('/messages', [DareMessageController::class, 'store'])->name('dare-messages.store');
    Route::delete('/messages/{id}', [DareMessageController::class, 'destroy'])->name('dare-messages.destroy');

    Route::post('/reactions', [DareReactionController::class, 'store'])->name('dare-reactions.store');
    Route::delete('/reactions/{id}', [DareReactionController::class, 'destroy'])->name('dare-reactions.destroy');
});

require __DIR__ . '/auth.php';
