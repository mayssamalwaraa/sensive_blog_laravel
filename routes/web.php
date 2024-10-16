<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;




use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Theme Routes
Route::controller(ThemeController::class)->name('theme.')->group(function(){
    Route::get('/','index')->name('index');
    // Route::get('/category/{name}','category')->name('category');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');


});

//Subscriber Routes
Route::post('/subscriber/store',[SubscriberController::class,'store'])->name('subscriber.store');
//Contact Routes
Route::post('/contact/store',[ContactController::class,'store'])->name('contact.store');
//Blog Routes
Route::get('/my-blogs',[BlogController::class,'myBlogs'])->name('blogs.my-blogs');
Route::resource('blogs', BlogController::class);
//comment Route
Route::post('/comment/store',[CommentController::class,'store'])->name('comments.store');


require __DIR__.'/auth.php';
