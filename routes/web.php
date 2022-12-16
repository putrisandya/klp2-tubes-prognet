<?php

// use App\Http\Controllers\CrudController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatDiklatController;
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
// Route::get('/',function(){
//     return redirect('/crud');
// });
// Route::get('/crud',[CrudController::class,'index'])->name('crud.list');
// Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
// Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
// Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');
// Route::post('/crud/save', [CrudController::class,'save'])->name('crud.save');
// Route::post('/crud/{id}/update',[CrudController::class,'update'])->name('crud.update');


// Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');

Route::get('/',function(){
    return redirect('/crud');
});
Route::get('/crud',[PegawaiController::class,'index'])->name('crud.list');
Route::get('/crud/create',[PegawaiController::class,'create'])->name('crud.create');
Route::get('/crud/{id}/edit',[PegawaiController::class,'edit'])->name('crud.edit');
Route::delete('/crud/{id}',[PegawaiController::class,'deleteData'])->name('crud.delete');
Route::post('/crud/save', [PegawaiController::class,'save'])->name('crud.save');
Route::post('/crud/{id}/update',[PegawaiController::class,'update'])->name('crud.update');
Route::post('/crud/listData',[PegawaiController::class,'listData'])->name('crud.listData');


Route::get('/crud2',[RiwayatDiklatController::class,'index'])->name('crud.list');
Route::get('/crud2/create',[RiwayatDiklatController::class,'create'])->name('crud.create');
Route::get('/crud2/{id}/edit',[RiwayatDiklatController::class,'edit'])->name('crud.edit');
Route::delete('/crud2/{id}',[RiwayatDiklatController::class,'deleteData'])->name('crud.delete');
Route::post('/crud2/save', [RiwayatDiklatController::class,'save'])->name('crud.save');
Route::post('/crud2/{id}/update',[RiwayatDiklatController::class,'update'])->name('crud.update');
Route::post('/crud2/listData',[RiwayatDiklatController::class,'listData'])->name('crud.listData');