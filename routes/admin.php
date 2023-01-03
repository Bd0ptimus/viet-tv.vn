<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TvController;



use App\Http\Controllers\InteractionController;


Route::group(['prefix' => 'admin', 'as'=>'admin.'], function($route){
    $route->get('/account-manager', [ AdminController::class, 'index'])->name('accountManager');
    $route->any('/create-account/{accountType}', [ AdminController::class, 'createAccount'])->name('createAccount');
    $route->any('/change-info-account/{userId}', [ AdminController::class, 'changeInfoAccount'])->name('changeInfoAccount');
    $route->get('/send-account-detail/{userId}/{pageId}', [ AdminController::class, 'sendAccountDetailToUser'])->name('sendAccountDetail');
    $route->get('/suspend-account/{userId}', [ AdminController::class, 'suspendAccount'])->name('suspendAccount');
    $route->get('/active-account/{userId}', [ AdminController::class, 'activeAccount'])->name('activeAccount');
    $route->post('/change-password', [ AdminController::class, 'changePassword'])->name('changePassword');
    $route->get('change-status/{type}/{userId}', [ AdminController::class, 'changeStatus'])->name('changeStatus');

});
