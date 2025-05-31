<?php

use App\Livewire\Cart;
use App\Livewire\TeamBuilder;
use App\Livewire\Home;
use App\Livewire\TeamEditor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', Home::class)->name('home');
Route::get('/cart', Cart::class)->name('cart');
