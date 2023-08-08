<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;

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

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Auth::routes(['verify' => true]);


Route::get('/home', [HomeController::class, 'index'])->name('post.index');

Route::post('/post', [HomeController::class, 'store'])->name('home.store');
Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::put('/post/{id}', [HomeController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [HomeController::class, 'destroy'])->name('post.destroy');

Route::post('/post/comment/{id}', [HomeController::class, 'commentStore'])->name('comment.store');
Route::delete('/post/comment/{id}', [HomeController::class, 'commentDestroy'])->name('comment.destroy');


Route::get("/profile/{slug}", [ProfileController::class, "show"])->name("profile.show");
Route::get("/profile/{slug}/edit", [ProfileController::class, "edit"])->name("profile.edit");
Route::put("/profile/{id}", [ProfileController::class, "update"])->name("profile.update");
Route::delete("/profile/{id}", [ProfileController::class, "destroy"])->name("profile.destroy");
Route::get("/profile/posts/{slug}", [ProfileController::class, "posts"])->name("profile.posts");

Route::get("/profile/{slug}/edit/password", [ProfileController::class, "editPassword"])->name("profile.edit.password");
Route::post("/profile/edit/password", [ProfileController::class, "updatePassword"])->name("profile.update.password");


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::put('/admin/users/{id}', [AdminController::class, 'disableUser'])->name('admin.disable.user');
Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.destroy.user');
Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts');
Route::put('/admin/posts/{id}', [AdminController::class, 'disablePosts'])->name('admin.disable.posts');
Route::delete('/admin/posts/{id}', [AdminController::class, 'destroyPosts'])->name('admin.destroy.posts');
Route::get('/admin/posts/{id}/comments', [AdminController::class, 'comments'])->name('admin.comments');
Route::put('/admin/comment/{id}', [AdminController::class, 'disableComments'])->name('admin.disable.comments');
Route::delete('/admin/comment/{id}', [AdminController::class, 'destroyComments'])->name('admin.destroy.comments');

// RUTAS NEGADAS PARA USUARIOS SIN ADMI 
Route::get('/acceso-no-autorizado', function () {
    return view('error/access'); 
})->name('acceso-no-autorizado');

Route::get('/status', function () {
    return view('error/status'); 
})->name('status');