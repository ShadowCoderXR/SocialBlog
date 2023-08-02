<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/profile/{slug}", [App\Http\Controllers\ProfileController::class, "index"])->name("profile.index");
Route::get("/profile/{slug}/edit", [App\Http\Controllers\ProfileController::class, "edit"])->name("profile.edit");
Route::get("/profile/{slug}/edit/password", [App\Http\Controllers\ProfileController::class, "editPassword"])->name("profile.edit.password");
Route::put("/profile/{slug}/edit/password", [App\Http\Controllers\ProfileController::class, "updatePassword"])->name("profile.update.password");
Route::put("/profile/{slug}", [App\Http\Controllers\ProfileController::class, "update"])->name("profile.update");
Route::get("/profile/{slug}/posts", [App\Http\Controllers\ProfileController::class, "posts"])->name("profile.posts");
Route::delete("/profile/{slug}", [App\Http\Controllers\ProfileController::class, "destroy"])->name("profile.destroy");



