<?php

use App\AppPlugin\Customers\ShoppingCartController;
use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\RouteNotFoundController;
use App\Http\Controllers\web\BlogViewController;
use App\Http\Controllers\web\BrandViewController;
use App\Http\Controllers\web\PagesViewController;
use App\Http\Controllers\web\ProductsCategoriesViewController;
use App\Http\Controllers\web\ProductsPageController;
use App\Http\Controllers\web\ProductsViewController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['prefix' => config('app.configAdminDir')], function () {
        Route::get('/admin-login', [AuthAdminController::class, 'AdminLogIn'])->name('admin.login');
        Route::post('/loginCheck', [AuthAdminController::class, 'AdminLoginCheck'])->name('AdminLoginCheck');
        Route::post('/logout', [AuthAdminController::class, 'AdminLogout'])->name('admin.logout');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/under-construction', [PagesViewController::class, 'UnderConstruction'])->name('UnderConstruction');
});


Route::group(['middleware' => ['UnderConstruction', 'MinifyHtml']], function () {
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

        Route::post('/filter', [FilterBuilder::class, 'UrlFilterBuilder'])->name('FilterBuilder');
        Route::get('/filter/clear', [FilterBuilder::class, 'FilterClear'])->name('FilterClear');

        Route::get('/', [PagesViewController::class, 'index'])->name('page_index');
        Route::get('/about-us/', [PagesViewController::class, 'AboutUs'])->name('page_AboutUs');
        Route::get('/terms-and-conditions/', [PagesViewController::class, 'Trems'])->name('page_Trems');
        Route::get('/wish-list/', [PagesViewController::class, 'WishList'])->name('page_WishList');
        Route::get('/search/', [PagesViewController::class, 'Search'])->name('page_search');


        Route::get('/contact/', [PagesViewController::class, 'ContactUs'])->name('page_ContactUs');
        Route::post('/contact/SaveForm/', [PagesViewController::class, 'ContactSaveForm'])->name('ContactSaveForm');
        Route::get('/contact/thanks/', [PagesViewController::class, 'ContactUsThanksPage'])->name('ContactUsThanksPage');

        Route::get('/our-brands/', [BrandViewController::class, 'BrandList'])->name('BrandList');
        Route::get('/brands/{slug}', [BrandViewController::class, 'BrandView'])->name('BrandView');


        Route::get('/cart/', [ShoppingCartController::class, 'CartView'])->name('Shop_CartView');
        Route::get('/cart-confirm', [ShoppingCartController::class, 'CartConfirm'])->name('Shop_CartConfirm');
        Route::get('/shipping-confirm', [ShoppingCartController::class, 'ShippingConfirm'])->name('Shop_ShippingConfirm');
        Route::get('/address-update', [ShoppingCartController::class, 'ShippingAddressUpdate'])->name('Shop_AddressUpdate');
        Route::post('/cart-save', [ShoppingCartController::class, 'NoneUserOrderSave'])->name('Shop_NoneUserOrderSave');
        Route::get('/order-completed', [ShoppingCartController::class, 'CartOrderCompleted'])->name('Shop_CartOrderCompleted');

        Route::get('/shop/', [ProductsPageController::class, 'ShopView'])->name('page_ShopView');
        Route::get('/offers/', [ProductsPageController::class, 'Offers'])->name('page_Offers_x');

        Route::get('/products/categories', [ProductsCategoriesViewController::class, 'ProductsCategoriesList'])->name('ProductsCategoriesList');
        Route::get('/product-category/{slug}', [ProductsCategoriesViewController::class, 'ProductsCategoriesView'])->name('ProductsCategoriesView');
        Route::get('/product-tag/{slug}', [ProductsCategoriesViewController::class, 'ProductsTagView'])->name('ProductsTagView');
        Route::get('/product/{slug}', [ProductsViewController::class, 'ProductView'])->name('ProductView');

        Route::get('/blog', [BlogViewController::class, 'BlogList'])->name('BlogList');
        Route::get('/category/{slug}', [BlogViewController::class, 'BlogCategoryView'])->name('BlogCategoryView');
        Route::get('/author/{slug}', [BlogViewController::class, 'BlogAuthorView'])->name('BlogAuthorView');
        Route::get('/tag/{slug}', [BlogViewController::class, 'BlogTagView'])->name('BlogTagView');
        Route::get('/{slug}', [BlogViewController::class, 'BlogView'])->name('BlogView')->where('slug', '(.*)');
    });
});

Route::fallback(RouteNotFoundController::class);

