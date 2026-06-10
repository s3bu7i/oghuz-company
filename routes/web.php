<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('/lang/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['az', 'en'], true), 404);

    session(['locale' => $locale]);

    return back();
})->name('language.switch');

// ── Public Routes ──────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/xidmetler', [HomeController::class, 'services'])->name('services');
Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.post');
Route::get('/elaqe', [HomeController::class, 'contact'])->name('contact');
Route::post('/elaqe/gonder', [HomeController::class, 'sendContact'])->name('contact.send');
Route::get('/api/stats', [HomeController::class, 'getStats'])->name('api.stats');

// ── Admin Routes ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('posts', PostController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('testimonials', TestimonialController::class);

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

// ── Admin Login (simple) ───────────────────────────────────────────────────────
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login')->withoutMiddleware('admin.auth');

Route::post('/admin/login', function (\Illuminate\Http\Request $request) {
    $username = env('ADMIN_USERNAME', 'admin');
    $password = env('ADMIN_PASSWORD', 'oghuztech2024');
    if ($request->username === $username && $request->password === $password) {
        session(['admin_logged_in' => true]);
        return redirect()->route('admin.dashboard');
    }
    return back()->withErrors(['login' => 'İstifadəçi adı və ya şifrə yanlışdır!']);
})->name('admin.login.post')->withoutMiddleware('admin.auth');

Route::post('/admin/logout', function () {
    session()->forget('admin_logged_in');
    return redirect()->route('admin.login');
})->name('admin.logout');
