<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\LandingPage;
use App\AppPlugin\Product\Models\Product;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Illuminate\Http\Request;


class ProductsPageController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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

        if ($products->isEmpty() and isset($_GET['page'])) {
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
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Offers(Request $request) {
        $meta = parent::getMeatByCatId('offers');
        parent::printSeoMeta($meta, 'page_Offers');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'Offers';

        $offers = LandingPage::query()->where('is_active', true)
            ->with('barnd')
            ->get();
//            ->paginate(100);

//        foreach ($offers as $offer){
//            dd($offer->barnd->photo_thum_1);
//            dd($offer->brand->first()->photo);
//        }

        if ($offers->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }
        return view('web.products_page.offers')->with([
            'meta' => $meta,
            'pageView' => $pageView,
            'offers' => $offers,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

    public function OffersView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $offer = LandingPage::whereTranslation('slug', $slug)
                ->translatedIn()
                ->with('translation')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($offer, 'page_OffersView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Offers';
        $pageView['page'] = 'Offers';

        if (count($offer->translations) == 1) {
            $pageView['go_home'] = route('page_index');
        } else {
            $pageView['slug'] = "brands/" . $offer->translate(webChangeLocale())->slug;
        }

        $products = Product::query()->whereIn('id', $offer->product_id)->get();


        if ($offer->is_soft) {
            return view('web.products_page.offers_view_soft')->with([
                'pageView' => $pageView,
                'offer' => $offer,
                'products' => $products,
            ]);
        } else {
            return view('web.products_page.offers_view')->with([
                'pageView' => $pageView,
                'offer' => $offer,
                'products' => $products,
            ]);
        }
    }

}
