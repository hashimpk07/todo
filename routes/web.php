<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToDOController;
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
    return view('auth.login');
});

// Login  Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// todo  Routes
Route::get('todo', [ToDOController::class, 'index'])->name('todo');
Route::post('todo.store',[ToDOController::class, 'store'])->name('todo.create');
Route::get('todo/add',[ToDOController::class, 'create'])->name('todo.add');
Route::get('todo.edit/{id}',[ToDOController::class, 'edit'])->name('todo.edit');
Route::post('todo.update',[ToDOController::class, 'update'])->name('todo.update');
Route::get('todo.delete/{id}',[ToDOController::class, 'destroy'])->name('todo.delete');
Route::get('todo.show/{id}',[ToDOController::class, 'show'])->name('todo.show');
Route::get('todo.share',[ToDOController::class, 'share'])->name('todo.share');
Route::get('todo.share-add/{id}',[ToDOController::class, 'shareAdd'])->name('todo.shareAdd');
Route::post('todo.share-store',[ToDOController::class, 'storeShareData'])->name('todo.share.create');
Route::post('todo.like',[ToDOController::class, 'likeUnLike'])->name('todo.like');