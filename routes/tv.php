<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;



use App\Http\Controllers\TvController;


Route::group(['prefix' => 'tv', 'as'=>'tv.'], function($route){
    $route->get('/', [ TvController::class, 'index'])->name('index');
    $route->post('/choose-category', [ TvController::class, 'chooseCategory'])->name('chooseCategory');
    $route->post('/search-channel',[TvController::class, 'searchChannel'])->name('searchChannel');
    $route->get('/old',[TvController::class, 'tvOld'])->name('tvOld');
    $route->post('/update-banner-player',[TvController::class, 'updateBanner'])->name('updateBanner');

    $route->group(['prefix'=>'admin', 'as'=>'admin.'], function($route){
        $route->get('/', [TvController::class, 'tvManagerIndex'])->name('index');
        $route->post('/add-category', [TvController::class, 'addCategory'])->name('addCategory');
        $route->post('/remove-category', [TvController::class, 'removeCategory'])->name('removeCategory');
        $route->post('/add-channel', [TvController::class, 'addChannel'])->name('addChannel');
        $route->post('/remove-channel', [TvController::class, 'removeChannel'])->name('removeChannel');
        $route->post('/update-category',[TvController::class, 'updateCategory'])->name('updateCategory');

    });
});
