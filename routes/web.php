<?php

use App\Livewire\MacAddress;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->redirectToRoute('welcome', status: 302);
});

Route::get('/dashboard', Welcome::class)->name('welcome');
Route::get('/macaddress', MacAddress::class)->name('macaddress');