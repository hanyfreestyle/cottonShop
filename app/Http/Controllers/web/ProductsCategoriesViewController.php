<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\Product\Helpers\FilterBuilder;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\AppPlugin\Product\Models\ProductTags;
use App\Helpers\AdminHelper;
use App\Http\Controllers\WebMainController;
use Illuminate\Http\Request;


class ProductsCategoriesViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ProductsCategoriesList
    public function ProductsCategoriesList() {

        $meta = parent::getMeatByCatId('products_categories');
        parent::printSeoMeta($meta, 'ProductsCategoriesList');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'ProductsCategories';
        $pageView['page'] = 'page_ProductsCategories';

        $categories = Category::defWep()
            ->where('parent_id', null)
            ->having('products_count', '>', 0)
            ->orderby('products_count', 'desc')
            ->paginate(20);

        if($categories->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.products_categories.index')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'categories' => $categories,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ProductsCategoriesView
    public function ProductsCategoriesView($slug, Request $request) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $category = Category::defWep()->whereTranslation('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($category, 'ProductsCategoriesView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'ProductsCategories';
        $pageView['page'] = 'page_ProductsCategories';
        $pageView['page'] = 'HanyX';
        $catid = $category->id;
        $trees = Category::find($category->id)->ancestorsAndSelf()->orderBy('depth', 'asc')->get();

        if(count($category->translations) == 1) {
            $pageView['slug'] = route('page_index');
        } else {
            $pageView['slug'] = "product-category/" . $category->translate(webChangeLocale())->slug;
        }


        $filters = new FilterBuilder();
        $productsQuery = $filters->getProductQuery($request, Product::defWepAll());
        $filterData = $filters->setfilterCategory(false)->getFilterQuery($productsQuery);


        $products = $productsQuery->whereHas('categories', function ($query) use ($catid) {
            $query->where('category_id', $catid);
        })->paginate(12)->appends(request()->query());

        if($products->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.products_categories.view')->with([
            'pageView' => $pageView,
            'category' => $category,
            'trees' => $trees,
            'products' => $products,
            'filterData' => $filterData,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ProductsTagView
    public function ProductsTagView($slug, Request $request) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $tag = ProductTags::whereTranslation('slug', $slug)->with('translations')->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }
        parent::printSeoMeta($tag, 'ProductsTagView');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = '';
        $pageView['page'] = 'page_ProductsCategories';
        $pageView['page'] = 'HanyX';
        $catid = $tag->id;


        if(count($tag->translations) == 1) {
            $pageView['slug'] = route('page_index');
        } else {
            $pageView['slug'] = "product-tag/" . $tag->translate(webChangeLocale())->slug;
        }

        $filters = new FilterBuilder();
        $productsQuery = $filters->getProductQuery($request, Product::defWepAll());
        $filterData = $filters->getFilterQuery($productsQuery);


        $products = $productsQuery->whereHas('tags', function ($query) use ($catid) {
            $query->where('tag_id', $catid);
        })->paginate(12)->appends(request()->query());

        if($products->isEmpty() and isset($_GET['page'])) {
            self::abortError404('Empty');
        }

        return view('web.products_tag.view')->with([
            'pageView' => $pageView,
            'tag' => $tag,
            'products' => $products,
            'filterData' => $filterData,
        ]);

    }

}
