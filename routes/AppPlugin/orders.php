<?php



use App\AppPlugin\Orders\OrderController;
use App\AppPlugin\Orders\ShippingController;
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

Route::get('/orders/search',[OrderController::class,'search'])->name('ShopOrders.Search.form');
Route::post('/orders/search', [OrderController::class, 'search'])->name('ShopOrders.Search.filter');

Route::post('/orders/ConfirmNew/{uuid}',[OrderController::class,'ConfirmNew'])->name('ShopOrders.ConfirmNew');
Route::post('/orders/ConfirmPending/{uuid}',[OrderController::class,'ConfirmPending'])->name('ShopOrders.ConfirmPending');

Route::get('/shipping/',[ShippingController::class,'index'])->name('ShopOrders.Shipping.index');
Route::get('/shipping/create',[ShippingController::class,'createList'])->name('ShopOrders.Shipping.create');
Route::get('/shipping/edit/{id}',[ShippingController::class,'edit'])->name('ShopOrders.Shipping.edit');
Route::post('/shipping/update/{id}',[ShippingController::class,'storeUpdate'])->name('ShopOrders.Shipping.update');
Route::get('/shipping/destroy/{id}',[ShippingController::class,'destroy'])->name('ShopOrders.Shipping.destroy');

Route::get('/shipping/rates/{id}',[ShippingController::class,'ratesIndex'])->name('ShopOrders.Shipping.ratesIndex');
Route::get('/shipping/rates/edit/{id}',[ShippingController::class,'editRate'])->name('ShopOrders.Shipping.editRates');
Route::post('/shipping/rates/update/{id}',[ShippingController::class,'updateRates'])->name('ShopOrders.Shipping.updateRates');
Route::get('/shipping/rates/destroy/{id}',[ShippingController::class,'destroyRates'])->name('ShopOrders.Shipping.destroyRates');
