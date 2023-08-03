<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\HomeController;
use App\http\Controllers\ProfileController;

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
});

Auth::routes();


Route::get('/post', [App\Http\Controllers\HomeController::class, 'index'])->name('post.index');

Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/post/{slug}/edit', [HomeController::class, 'edit'])->name('post.edit');
Route::post('/post/create', [HomeController::class, 'store'])->name('post.store');
Route::put('/post/{id}', [HomeController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [HomeController::class, 'destroy'])->name('post.destroy');
Route::post('/post/{id}/comment', [HomeController::class, 'commentStore'])->name('comment.store');
Route::delete('/post/{id}', [HomeController::class, 'commentDestroy'])->name('comment.destroy');

Route::get("/profile/{slug}", [App\Http\Controllers\ProfileController::class, "show"])->name("profile.show");
Route::get("/profile/{slug}/edit", [App\Http\Controllers\ProfileController::class, "edit"])->name("profile.edit");
Route::get("/profile/{slug}/edit/password", [App\Http\Controllers\ProfileController::class, "editPassword"])->name("profile.edit.password");
Route::put("/profile/{id}/edit/password", [App\Http\Controllers\ProfileController::class, "updatePassword"])->name("profile.update.password")->middleware(['password.confirm']);
Route::put("/profile/{id}", [App\Http\Controllers\ProfileController::class, "update"])->name("profile.update");
Route::get("/profile/{slug}/posts", [App\Http\Controllers\ProfileController::class, "posts"])->name("profile.posts");
Route::delete("/profile/{id}", [App\Http\Controllers\ProfileController::class, "destroy"])->name("profile.destroy");



