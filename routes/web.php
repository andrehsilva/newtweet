<?php

use App\Http\Livewire\Link\EditLinks;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\User\UploadPhoto;
use App\Http\Livewire\Link\ShowLinks;
use App\Http\Livewire\Todo\Todo;
use App\Http\Livewire\User\UsersEdit;
use App\Http\Livewire\Tweet\ShowTweets;
use App\Http\Livewire\User\UsersCreate;
use App\Http\Livewire\User\UsersTable;

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

Route::get('/users', UsersTable::class)->name('users.list')->middleware('auth');
/* Route::get('/users/create', UsersCreate::class)->name('users.create')->middleware('auth');
Route::get('/users/edit/{id}', UsersEdit::class)->name('users.edit')->middleware('auth'); */


Route::get('/upload', UploadPhoto::class)->name('upload.photo.user')->middleware('auth');
Route::get('/', ShowTweets::class)->name('tweets.index')->middleware('auth');

Route::get('/links', ShowLinks::class)->name('links.index')->middleware('auth');
Route::get('/links/edit/{id}', ShowLinks::class, 'editLinkModal')->name('links.edit')->middleware('auth');

Route::get('/todo', Todo::class)->name('todo.index')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
