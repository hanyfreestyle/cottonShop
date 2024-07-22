<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Illuminate\Http\Request;


class BrandViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BrandList() {

        $meta = parent::getMeatByCatId('brand');
        parent::printSeoMeta($meta, 'BrandList');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Brand';
        $pageView['page'] = 'page_Brand';

        $brands = Brand::defWep()
            ->having('products_count', '>', 0)
            ->orderby('products_count', 'desc')
            ->paginate(20);


        if ($brands->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.brand.index')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'brands' => $brands,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BrandView($slug, Request $request) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $brand = Brand::whereTranslation('slug', $slug)
                ->translatedIn()
                ->with('translation')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($brand, 'BrandView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Brand';
        $pageView['page'] = 'BrandView';

        if (count($brand->translations) == 1) {
            $pageView['go_home'] = route('page_index');
        } else {
            $pageView['slug'] = "brands/" . $brand->translate(webChangeLocale())->slug;
        }

        $filters = new FilterBuilder();
        $productsQuery = $filters->getProductQuery($request, Product::defWepAll());
        $filterData = $filters->setfilterBrand(false)->getFilterQuery($productsQuery);

//        $products = $productsQuery->where('brand_id', $brand->id)->paginate(12)->appends(request()->query());
        $products = $productsQuery->where('brand_id', $brand->id)
            ->join('pro_categories', 'pro_categories.id','=','products.categories.id')
//            ->with(['categories' => function ($q){
//                $q->orderBy('category_id', 'DESC');
//            }])
            ->paginate(12)->appends(request()->query());


        if ($products->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.brand.view')->with([
            'pageView' => $pageView,
            'brand' => $brand,
            'products' => $products,
            'filterData' => $filterData,
        ]);

    }

}
