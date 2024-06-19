<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\Product\Helpers\LoadProductInfo;
use App\AppPlugin\Product\Models\Product;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;


class ProductsViewController extends WebMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ProductView
    public function ProductView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $product = Product::defWepAll()
                ->whereTranslation('slug', $slug)
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($product, 'ProductView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'ProductsCategories';
        $pageView['page'] = 'page_ProductsCategories';
        $pageView['page'] = 'page_indexXXX';

        if(count($product->translations) == 1) {
            $pageView['slug'] = route('page_index');
        } else {
            $pageView['slug'] = "product/" . $product->translate(webChangeLocale())->slug;
        }


        $catid = $product->categories->first()->id;

        $recently = Product::defWepAll()->inRandomOrder()->take(10)->get();

        $related = Product::defWepAll()->where('id', "!=", $product->id)->whereHas('categories', function ($query) use ($catid) {
            $query->where('category_id', $catid);
        })->inRandomOrder()->take(10)->get();

        $LoadProductInfo = new LoadProductInfo();
        $productInfo = $LoadProductInfo->getInfo($product);

        return view('web.product_view')->with([
            'pageView' => $pageView,
            'product' => $product,
            'recently' => $recently,
            'related' => $related,
            'productInfo' => $productInfo,
        ]);

    }


}
