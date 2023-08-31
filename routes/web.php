<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/customer/register','cus tomer.insert');
Route::get('/customer/home',[CustomerController::class,'home'])->name('customer#home');
Route::post('/customer/insert',[CustomerController::class,'insert'])->name('customer#insert');
Route::get('/customer/data',[CustomerController::class,'read'])->name('customer#data');

//start project
// Route::get('/',[PostController::class,'create'])->name('home#create');
Route::redirect('/','/customer/create',302);
Route::get('/customer/create',[PostController::class,'create'])->name('customer#create');
Route::post('/post/create',[PostController::class,'postCreate'])->name('post#create');
Route::delete('post/delete/{id}',[PostController::class,'postDelete'])->name('post#delete');
Route::post('post/seemore/{id}',[PostController::class,'postSeemore'])->name('post#seemore');
Route::post('post/edit/{id}',[PostController::class,'postEdit'])->name('post#edit');
Route::post('post/update',[PostController::class,'postUpdate'])->name('post#update');
Route::post('user',[PostController::class,'postCall']);
