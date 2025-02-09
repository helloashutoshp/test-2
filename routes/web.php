<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\basicController;

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



Route::group(['prefix' => '/basic'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::post('/login', [basicController::class, 'loginAction'])->name('admin-authenticate');
        Route::get('/login', [basicController::class, 'login'])->name('admin.login');
    });
 Route::group(['middleware'=>'admin.auth'],function(){
     Route::get('/register', [basicController::class, 'create'])->name('create');
    Route::post('/register', [basicController::class, 'store'])->name('store');
    Route::get('/logout', [basicController::class, 'logout'])->name('logout');
    Route::get('/show', [basicController::class, 'show'])->name('show');
    Route::get('/delete/{id}', [basicController::class, 'delete'])->name('delete');
    Route::get('/edit/{id}', [basicController::class, 'edit'])->name('edit');
    Route::get('/deleteimage', [basicController::class, 'deleteImg'])->name('deleteImage');
    Route::post('/update', [basicController::class, 'update'])->name('update');
 });
   
});
