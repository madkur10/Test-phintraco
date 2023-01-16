<?php

use App\Models\Projects;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\Controller;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login_action', [AuthController::class, 'loginAction'])->name('login.action');
Route::get('/logout_action', [AuthController::class, 'logoutAction'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [AuthController::class, 'home'])->name('homepage');

    Route::prefix('users')->group(function () {
        Route::get('index', [UsersController::class, 'index'])->name('users');
        Route::post('create', [UsersController::class, 'store'])->name('user.add');
        Route::put('update', [UsersController::class, 'update'])->name('user.update');
        Route::get('delete', [UsersController::class, 'destroy'])->name('user.delete');
    });
    
    Route::prefix('projects')->group(function () {
        Route::get('index', [ProjectsController::class, 'index'])->name('projects');
        Route::post('create', [ProjectsController::class, 'store'])->name('project.add');
        Route::put('update', [ProjectsController::class, 'update'])->name('project.update');
        Route::get('delete', [ProjectsController::class, 'destroy'])->name('project.delete');
    });
});