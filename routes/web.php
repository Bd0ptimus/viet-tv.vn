<?php

use Illuminate\Support\Facades\Route;

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
require_once 'auth.php';
require_once 'admin.php';
require_once 'tv.php';



// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/test', function () {
    return view('layouts.registerAndExtendUse');
});

Route::get('/storage-link', function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = public_path('storage');
    symlink($targetFolder, $linkFolder);
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
