<?php

namespace App\Http\Controllers\admin;

use App\AppCore\DefPhoto\ConfigLinks;
use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\AdminMainController;
use App\Helpers\PDF;
use DOMDocument;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


class BackLinksController extends AdminMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function listBackLink() {

        $RouteName = Route::currentRouteName();
        if ($RouteName == 'admin.listBackLink') {
            $cat = "barnd";
            $editRoute = 'admin.Shop.Brand.edit';
            $newScan = 'admin.scanBrand';
        } elseif ($RouteName == 'admin.listBackLinkProduct') {
            $cat = "product";
            $editRoute = 'admin.Shop.Product.edit';
            $newScan = 'admin.scanProducts';
        } elseif ($RouteName == 'admin.listBackLinkBlog') {
            $cat = "blog";
            $editRoute = 'admin.Blog.BlogPost.edit';
            $newScan = 'admin.scanBlog';
        }


        $links = ConfigLinks::query()
            ->where('cat', $cat)
            ->where('url', '!=', "cottton.shop")->get();
        return view('admin.back_links')->with([
            'links' => $links,
            'editRoute' => $editRoute,
            'newScan' => $newScan,

        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scanBrand() {
        ConfigLinks::query()->where('cat', 'barnd')->delete();
        $brands = Brand::query()->with('translation')->get();
        $links = [];
        foreach ($brands as $brand) {
            $newLink = self::extractLinks($brand->des, $brand->id, 'barnd');
            $links = array_merge($links, $newLink);
        }

        foreach ($links as $link) {
            self::SaveLinks($link);
        }
        return redirect()->route('admin.listBackLink');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scanBlog() {
        ConfigLinks::query()->where('cat', 'blog')->delete();
        $blogs = Blog::query()->with('translation')->get();
        $links = [];
        foreach ($blogs as $blog) {
            $newLink = self::extractLinks($blog->des, $blog->id, 'blog');
            $links = array_merge($links, $newLink);
        }
        foreach ($links as $link) {
            self::SaveLinks($link);
        }
        return redirect()->route('admin.listBackLinkBlog');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function scanProducts() {
        ConfigLinks::query()->where('cat', 'product')->delete();
        $products = Product::query()->where('parent_id', null)->with('translation')->get();
        $links = [];
        foreach ($products as $product) {
            $newLink = self::extractLinks($product->des, $product->id, 'product');
            $links = array_merge($links, $newLink);
        }
        foreach ($links as $link) {
            self::SaveLinks($link);
        }
        return redirect()->route('admin.listBackLinkProduct');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function SaveLinks($link) {
        $url = self::getDomain($link['href']);
        if ($url != 'cottton.shop') {
            $saveLink = new ConfigLinks();
            $saveLink->href = $link['href'];
            $saveLink->href_id = $link['id'];
            $saveLink->type = $link['type'];
            $saveLink->cat = $link['cat'];
            $saveLink->url = $url;
            $saveLink->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    function getDomain($url) {
        $parsedUrl = parse_url($url);
        return $parsedUrl['host'];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    function extractLinks($htmlContent, $id, $cat) {
        $dom = new DOMDocument();

        // تحميل HTML وتحليل المحتوى
        @$dom->loadHTML($htmlContent);

        // للحصول على جميع الروابط والصور
        $links = [];

        // الحصول على الروابط (a) من HTML
        foreach ($dom->getElementsByTagName('a') as $node) {
            $href = $node->getAttribute('href');
            if ($href) {
//                $links[] = $href;
                $links[] = ['href' => $href, 'id' => $id, 'type' => 'link', 'cat' => $cat];
            }
        }

        // الحصول على روابط الصور (img) من HTML
        foreach ($dom->getElementsByTagName('img') as $node) {
            $src = $node->getAttribute('src');
            if ($src) {
//                $links[] = $src;
                $links[] = ['href' => $src, 'id' => $id, 'type' => 'img', 'cat' => $cat];
            }
        }

        return $links;
    }


}
