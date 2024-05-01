<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\User\BlogController;
//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [BlogsController::class, 'index'])->name('home');
Route::get('/aboutUs', [BlogsController::class, 'about'])->name('aboutUs');

Route::get('/categories/{slug:categories}', [BlogsController::class, 'category'])->name('blogs.category');

Route::get('/blogs', [BlogsController::class, 'blog'])->name( 'blogs' );
Route::get('/blogs/{slug}', [BlogsController::class, 'blogDetails'])->name( 'blogs.details' );
Route::post('/blogs/comment/{blog_id}', [BlogsController::class, 'blogCommentStore'])->name( 'blogs.comment.store' );
Route::post('/blogs/favorite', [BlogsController::class, 'blogFavorite'])->name( 'blogs.favorite' );
Route::post('/blogs/comment-favorite', [BlogsController::class, 'blogCommentFavorite'])->name( 'blogs.comment.favorite' );

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

/** User Blog Routes */
Route::group(['prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('favorite-list', [DashboardController::class, 'favoriteList'])->name('favoriteList');
    Route::get('change-password', [DashboardController::class, 'changePassword'])->name('changePassword');
    Route::resource('blogs', BlogController::class);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

});


/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

require __DIR__.'/auth.php';


