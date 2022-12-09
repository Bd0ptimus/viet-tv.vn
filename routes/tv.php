<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;



use App\Http\Controllers\TvController;


Route::group(['prefix' => 'tv', 'as'=>'tv.'], function($route){
    $route->get('/', [ TvController::class, 'index'])->name('index');
});
