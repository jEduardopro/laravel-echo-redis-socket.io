<?php

use App\Events\PrivateMessage;
use App\Events\PublicMessage;
use App\Notifications\StatusDevice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/chat', function(){
    event(new PublicMessage());
    dd('Public event executed successfully.');
});

Route::get('/private-chat', function(){
    event(new PrivateMessage(auth()->user()));
    dd('Private event executed successfully.');
});

Route::get('/notification', function(){
    Notification::send(auth()->user(), new StatusDevice());
    dd('Private Notification executed successfully.');
});
