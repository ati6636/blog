<?php

use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function(){

  Route::get('giris',[AuthController::class,'login'])->name('login');

  Route::post('giris',[AuthController::class,'loginPost'])->name('login.post');
});

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function(){

  Route::get('panel',[Dashboard::class, 'index'])->name('dashboard');

  Route::get('/makaleler/silinenler', [ArticleController::class, 'trashed'])->name('trashed.article');

  Route::resource('makaleler', ArticleController::class);

  Route::get('/switch', [ArticleController::class, 'switch'])->name('switch');

  Route::get('/deletearticle/{id}', [ArticleController::class, 'delete'])->name('delete.article');

  Route::get('/hardeletearticle/{id}', [ArticleController::class, 'hardDelete'])->name('hard.delete.article');

  Route::get('/recoveryarticle/{id}', [ArticleController::class, 'recovery'])->name('recovery.article');

  Route::get('cikis', [AuthController::class,'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [Homepage::class,'index'])->name('homepage');

Route::get('/iletisim',[Homepage::class, 'contact'])->name('contact');

Route::post('/iletisim',[Homepage::class, 'contactpost'])->name('contact.post');

Route::get('sayfa', [Homepage::class,'index']);

Route::get('/kategori/{slug}', [Homepage::class, 'category'])->name('category');

Route::get('/{category}/{slug}', [Homepage::class, 'single'])->name('single');

Route::get('/{sayfa}',[Homepage::class, 'page'])->name('page');
