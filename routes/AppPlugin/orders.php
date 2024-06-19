<?php


use App\AppPlugin\Orders\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/orders/',[OrderController::class,'index'])->name('ShopOrders.index');
Route::post('/orders/', [OrderController::class, 'index'])->name('ShopOrders.filter');
Route::get('/orders/DataTable',[OrderController::class,'DataTable'])->name('ShopOrders.DataTable');
Route::get('/orders/New',[OrderController::class,'index'])->name('ShopOrders.New.index');
Route::get('/orders/Pending',[OrderController::class,'index'])->name('ShopOrders.Pending.index');
Route::get('/orders/Recipient',[OrderController::class,'index'])->name('ShopOrders.Recipient.index');
Route::get('/orders/Rejected',[OrderController::class,'index'])->name('ShopOrders.Rejected.index');
Route::get('/orders/Canceled',[OrderController::class,'index'])->name('ShopOrders.Canceled.index');
Route::get('/orders/view/{uuid}',[OrderController::class,'OrderView'])->name('ShopOrders.OrderView');
Route::get('/orders/config', [OrderController::class,'config'])->name('ShopOrders.config');


Route::post('/orders/ConfirmNew/{uuid}',[OrderController::class,'ConfirmNew'])->name('ShopOrders.ConfirmNew');
Route::post('/orders/ConfirmPending/{uuid}',[OrderController::class,'ConfirmPending'])->name('ShopOrders.ConfirmPending');

//Route::get('/Orders/create',[CustomerController::class,'create'])->name('ShopOrders.Orders.create');




