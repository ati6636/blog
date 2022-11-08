<?php

use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
|
*/

Route::get('admin/panel',[Dashboard::class, 'index'])->name('admin.dashboard');

Route::get('admin/giris',[Auth::class,'login'])->name('admin.login');

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
