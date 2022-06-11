<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\maincontroller;
use App\http\Controllers\Notescontroller;
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
    return view('auth.login');
});


Route::post('/Auth/save',[maincontroller::class,'save'])->name('auth.save');
Route::Post('/Auth/check',[maincontroller::class,'check'])->name('auth.check');
Route::get('/Auth/logout',[maincontroller::class,'logout'])->name('auth.logout');
Route::post('save',[NotesController::class,'store'])->name('notes.save');
Route::get('create',[NotesController::class,'create'])->name('notes.create');
Route::get('show',[NotesController::class,'show'])->name('notes.show');

Route::group(['middleware'=>['AuthCheck']],function()
{
    Route::get('/Auth/login',[maincontroller::class,'login'])->name('auth.login');
    Route::get('/Auth/register',[maincontroller::class,'register'])->name('auth.register');
    Route::get('/dashboard',[maincontroller::class,'dashboard']);
    Route::get('notes',[NoteController::class,'index'])->name('notes');
});