<?php

use App\AppPlugin\CustomersAdmin\CustomerAdminController;
use Illuminate\Support\Facades\Route;


Route::get('/customer/',[CustomerAdminController::class,'index'])->name('ShopCustomer.index');
Route::get('/customer/DataTable',[CustomerAdminController::class,'DataTable'])->name('ShopCustomer.DataTable');
Route::get('/customer/create',[CustomerAdminController::class,'create'])->name('ShopCustomer.create');
Route::get('/customer/edit/{id}',[CustomerAdminController::class,'edit'])->name('ShopCustomer.edit');
Route::post('/customer/store',[CustomerAdminController::class,'store'])->name('ShopCustomer.store');
Route::post('/customer/update/{id}',[CustomerAdminController::class,'update'])->name('ShopCustomer.update');
Route::get('/customer/Password/{id}',[CustomerAdminController::class,'Password'])->name('ShopCustomer.Password');
Route::post('/customer/PassUpdate/{id}',[CustomerAdminController::class,'Password_Update'])->name('ShopCustomer.PasswordUpdate');

Route::get('/customer/destroy/{id}',[CustomerAdminController::class,'destroy'])->name('ShopCustomer.destroy');
Route::get('/customer/SoftDelete/',[CustomerAdminController::class,'SoftDeletes'])->name('ShopCustomer.SoftDelete');
Route::get('/customer/restore/{id}',[CustomerAdminController::class,'restored'])->name('ShopCustomer.restore');
Route::get('/customer/force/{id}',[CustomerAdminController::class,'ForceDeletes'])->name('ShopCustomer.force');
Route::get('/customer/Config',[CustomerAdminController::class,'config'])->name('ShopCustomer.config');





