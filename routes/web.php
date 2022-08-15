<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrackerController;
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
Route::get('admin',[AdminController::class,'index'])->name('admin');
Route::post('register',[AdminController::class,'register'])->name('admin.register');
Route::get('login')->name('login');


Route::get('admin/register',[AdminController::class,'regis'])->name('admin.regis');
Route::post('admin/auth',[AdminController::class,'auth'])->name('admin.auth');

Route::group(['middleware'=>'admin_auth'],function(){

    
Route::Post('admin/insert',[TrackerController::class,'insert'])->name('tracker.insert');
Route::get('admin/dashboard',[AdminController::class,'dashboard']);
Route::get('admin/tracker',[TrackerController::class,'index']);

Route::get('admin/work',[TrackerController::class,'work']);
Route::get('admin/day',[TrackerController::class,'day']);


});

