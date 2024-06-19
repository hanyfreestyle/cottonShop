<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\WebMainController;
use Illuminate\Http\Request;


class ProductsPageController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ShopView
    public function ShopView(Request $request) {

        $meta = parent::getMeatByCatId('shop');
        parent::printSeoMeta($meta, 'page_ShopView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'shop';
        $pageView['page'] = 'shop';

        $filters = new FilterBuilder();

        $productsQuery = $filters->getProductQuery($request, Product::defWepAll());
        $filterData = $filters->getFilterQuery($productsQuery);


        $products = $productsQuery->paginate(12)->appends(request()->query());

        if($products->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.products_page.shop')->with([
            'meta' => $meta,
            'pageView' => $pageView,
            'products' => $products,
            'filterData' => $filterData,
        ]);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ShopView
    public function Offers(Request $request) {

        $meta = parent::getMeatByCatId('offers');
        parent::printSeoMeta($meta, 'page_Offers');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'Offers';

        $products = Product::defwepall()->take(5)->paginate(12);

        if($products->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.products_page.offers')->with([
            'meta' => $meta,
            'pageView' => $pageView,
            'products' => $products,

        ]);

    }

}
