<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\http\Controllers\ProfileController;
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
});

Auth::routes(['verify' => true]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('post.index');
Route::post('/home', [HomeController::class, 'store'])->name('home.store');

Route::get('/post/{slug}', [HomeController::class, 'show'])->name('post.show');
Route::get('/post/{slug}/edit', [HomeController::class, 'edit'])->name('post.edit');
Route::post('/post/create', [HomeController::class, 'store'])->name('post.store');
Route::put('/post/{id}', [HomeController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [HomeController::class, 'destroy'])->name('post.destroy');
Route::post('/post/{id}/comment', [HomeController::class, 'commentStore'])->name('comment.store');
Route::delete('/post/{id}/comment', [HomeController::class, 'commentDestroy'])->name('comment.destroy');

Route::get("/profile/{slug}", [ProfileController::class, "show"])->name("profile.show");
Route::get("/profile/{slug}/edit", [ProfileController::class, "edit"])->name("profile.edit");
Route::get("/profile/{slug}/edit/password", [ProfileController::class, "editPassword"])->name("profile.edit.password");
Route::put("/profile/{id}/edit/password", [ProfileController::class, "updatePassword"])->name("profile.update.password")->middleware(['password.confirm']);
Route::put("/profile/{id}", [ProfileController::class, "update"])->name("profile.update");
Route::get("/profile/{slug}/posts", [ProfileController::class, "posts"])->name("profile.posts");
Route::delete("/profile/{id}", [ProfileController::class, "destroy"])->name("profile.destroy");



// RUTAS DEL ADMINISTRADOR || RUTAS EN LAS QUE TIENE ACCESO ADMI
Route::group(['middleware' => 'admin'], function () {
    // Route::get('/post/{slug}/edit', [HomeController::class, 'edit'])->name('post.edit');
    // Route::get("/profile/{slug}/edit", [ProfileController::class, "edit"])->name("profile.edit");


    // Route::get('/admin/dashboard', 'HomeController@dashboard')->name('post.edit'); 
});

// RUTAS NEGADAS PARA USUARIOS SIN ADMI 
Route::get('/acceso-no-autorizado', function () {
    return "Acceso no autorizado. Debes ser un administrador para acceder.";
})->name('acceso-no-autorizado');