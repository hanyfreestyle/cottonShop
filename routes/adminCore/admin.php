<?php

use App\Http\Controllers\admin\BackLinksController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\HooverDataController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::get('/change-collapse', [DashboardController::class, 'ChangeCollapse'])->name('ChangeCollapse');


if (File::isFile(base_path('app\AppPlugin\Crm\Periodicals\BookDashboardController.php'))) {

}elseif (File::isFile(base_path('app\AppPlugin\Product\ProductDashboardController.php'))){

} else {
    Route::get('/', [DashboardController::class, 'Dashboard'])->name('Dashboard');
}

Route::get('/testpdf', [DashboardController::class, 'testpdf'])->name('testpdf');
Route::get('/getConfigData', [HooverDataController::class, 'getConfigData'])->name('getConfigData');

Route::get('/listBackLink', [BackLinksController::class, 'listBackLink'])->name('listBackLink');
Route::get('/listBackLinkProduct', [BackLinksController::class, 'listBackLink'])->name('listBackLinkProduct');
Route::get('/listBackLinkBlog', [BackLinksController::class, 'listBackLink'])->name('listBackLinkBlog');


Route::get('/scanBrand', [BackLinksController::class, 'scanBrand'])->name('scanBrand');
Route::get('/scanBlog', [BackLinksController::class, 'scanBlog'])->name('scanBlog');
Route::get('/scanProducts', [BackLinksController::class, 'scanProducts'])->name('scanProducts');
Route::get('/scanLinks', [BackLinksController::class, 'scanLinks'])->name('scanLinks');








