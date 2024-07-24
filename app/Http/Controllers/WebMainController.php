<?php

namespace App\Http\Controllers;

use App\AppPlugin\Pages\Models\Page;
use App\AppPlugin\Product\Helpers\LoadProductInfo;
use App\AppPlugin\Product\Models\AttributeValue;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\Helpers\AdminHelper;
use App\Helpers\Seo\SchemaTools;

use App\Http\Controllers\web\FilterBuilderController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Phattarachai\LaravelMobileDetect\Agent;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;


class WebMainController extends DefaultMainController {


    public $pageView;
    public $StopeCash = 0;

    public function __construct() {
        parent::__construct();
        $this->StopeCash = 0;


        $agent = new Agent();
        View::share('agent', $agent);

        $this->WebConfig = self::getWebConfig($this->StopeCash);
        View::share('WebConfig', $this->WebConfig);

        $this->DefPhotoList = self::getDefPhotoList($this->StopeCash);
        View::share('DefPhotoList', $this->DefPhotoList);

        $pageView = [
            'SelMenu' => '',
            'page' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home' => null,
            'profileMenu' => null,
        ];

        $this->pageView = $pageView;
        View::share('pageView', $pageView);

        $this->cssMinifyType = "Web"; # Web , WebMini , Seo
        View::share('cssMinifyType', $this->cssMinifyType);

        $this->cssReBuild = true;
        View::share('cssReBuild', $this->cssReBuild);

        $this->printSchema = new SchemaTools();
        View::share('printSchema', $this->printSchema);

        $this->CashCategoryMenuList = self::CashCategoryMenuList();
        View::share('CashCategoryMenuList', $this->CashCategoryMenuList);

        $this->CashCategoryFilterList = self::CashCategoryFilterList();
        View::share('CashCategoryFilterList', $this->CashCategoryFilterList);


        $this->CashBrandMenuList = self::CashBrandMenuList(0);
        View::share('CashBrandMenuList', $this->CashBrandMenuList);

        $this->CashProductPageInfo = self::CashProductPageInfo(0);
        View::share('CashProductPageInfo', $this->CashProductPageInfo);

        $values = WebMainController::CashAttributeValueList();
        View::share('valuesName', $values);


        $cart = null;
        View::share('cart', $cart);


        $proStyle = new LoadProductInfo();
        $proStyle->getProductStyle();

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function printSeoMeta($row, $route = null, $defPhoto = "logo", $sendArr = array()) {
        if (File::isFile(base_path('routes/AppPlugin/config/configMeta.php'))) {
            $lang = thisCurrentLocale();
            $type = AdminHelper::arrIsset($sendArr, 'type', 'website');
            $ErrorPage = AdminHelper::arrIsset($sendArr, 'ErrorPage', false);

            if (isset($row->photo)) {
                $defImage = $row->photo;
            } else {
                $GetdefImage = self::getDefPhotoById($defPhoto);
                $defImage = optional($GetdefImage)->photo;
            }
            if ($defImage) {
                $defImage = defImagesDir($defImage);
            }

            $TitleInfo = self::TitleInfo($row, $route, $sendArr);

            $setTitle = $TitleInfo['Title'];
            $setDescription = $TitleInfo['Description'];


            SEOMeta::setTitle($setTitle);
            SEOMeta::setDescription($setDescription);


            if ($ErrorPage != true) {
                if ($route == 'BlogAuthorView') {
                    OpenGraph::setDescription($row->name ?? "");
                } else {
                    OpenGraph::setDescription($setDescription ?? "");
                }

                self::Urlinfo($row, $route);
                OpenGraph::setTitle($setTitle);
                OpenGraph::addProperty('type', $type);
                OpenGraph::setUrl(urldecode(url()->current()));
                OpenGraph::addImage($defImage);
                OpenGraph::setSiteName($this->WebConfig->name);

                TwitterCard::setTitle($setTitle);
                TwitterCard::setDescription($setDescription);
                TwitterCard::setUrl(urldecode(url()->current()));
                TwitterCard::setImage($defImage);
                TwitterCard::setImage($defImage);
                TwitterCard::setType('summary_large_image');
            }
        }


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function TitleInfo($row, $route, $sendArr) {
        $sendRows = AdminHelper::arrIsset($sendArr, 'sendRows', array());
        $sendRows2 = AdminHelper::arrIsset($sendArr, 'sendRows2', array());

        $siteName = " | " . $this->WebConfig->meta_des;

        switch ($route) {

            case 'BlogCategoryView':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "1";
                break;

            case 'BlogAuthorView':
                $setTitle = self::CheckMeta($row, 'name', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'name', 'name') . $siteName;
                $xx = "2";
                break;

            case 'BlogTagView':
                $setTitle = self::CheckMeta($row, 'name', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'name', 'name') . $siteName;
                $xx = "3";
                break;

            case 'BlogView':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "4";
                break;

            case 'ProductsCategoriesView':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "5";
                break;

            case 'ProductView':
                $setTitle = self::CheckMeta($row, 'g_title', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'g_des', 'des');
                $xx = "6";
                break;

            case 'ProductsTagView':
                $setTitle = self::CheckMeta($row, 'name', 'name') . $siteName;
                $setDescription = self::CheckMeta($row, 'name', 'name') . $siteName;
                $xx = "7";
                break;


            default:
                $setTitle = ($row->g_title ?? $row->name);
                $setDescription = ($row->g_des ?? $row->name);

        }

        $WebConfig = WebMainController::getWebConfig();
        $SiteName = $WebConfig->meta_des . " | ";

        $rep1 = array("%SiteName%");
        $rep2 = array($SiteName);
        $setTitle = str_replace($rep1, $rep2, $setTitle);
        $setDescription = str_replace($rep1, $rep2, $setDescription);

        $setTitle = Str::limit($setTitle,70,"");
        $setDescription = Str::limit($setDescription,160,"");
        return ['Title' => $setTitle, 'Description' => $setDescription];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    Urlinfo
    static function Urlinfo($row, $route) {
        $lang = thisCurrentLocale();
        $alternatUrl = null;
        $pages = null;

        if ($lang == 'en') {
            $alternateLang = 'ar';
        } elseif ($lang == 'ar') {
            $alternateLang = 'en';
        }

        if (isset($_GET['page'])) {
            $pages = "page=" . $_GET['page'];
        }

        switch ($route) {
            case 'page_index':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('page_index')));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('page_index')));
                break;

            case 'BlogAuthorView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('BlogAuthorView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('BlogAuthorView', [$row->slug, $pages])));
                break;

            case 'BlogCategoryView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('BlogCategoryView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('BlogCategoryView', [$row->slug, $pages])));
                break;

            case 'BlogView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('BlogView', $row->slug)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('BlogView', $row->slug)));
                break;

            case 'BlogTagView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('BlogTagView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('BlogTagView', [$row->slug, $pages])));
                break;

            case 'BrandView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('BrandView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('BrandView', [$row->slug, $pages])));
                break;

            case 'ProductsCategoriesView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('ProductsCategoriesView', $row->slug)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('ProductsCategoriesView', $row->slug)));
                break;

            case 'ProductsTagView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('ProductsTagView', [$row->slug, $pages])));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('ProductsTagView', [$row->slug, $pages])));
                break;

            case 'ProductView':
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route('ProductView', $row->slug)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route('ProductView', $row->slug)));
                break;

            default:
                $Url = urldecode(LaravelLocalization::getLocalizedURL($lang, route($route, $pages)));
                $alternatUrl = urldecode(LaravelLocalization::getLocalizedURL($alternateLang, route($route, $pages)));
                break;

        }

        if ($route != null) {
            SEOMeta::addAlternateLanguage($lang, $Url);
            if ($alternatUrl != null and count(config('app.web_lang')) > 1) {
                SEOMeta::addAlternateLanguage($alternateLang, $alternatUrl);
            }
            SEOMeta::setCanonical($Url);
        }

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   CheckMeta
    public function CheckMeta($row, $def, $other) {
        if ($row->$def == null) {
            $meta = AdminHelper::seoDesClean($row->$other);
        } else {
            $meta = $row->$def;
        }
        return $meta;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function abortError404($from = "root") {

        $Meta = DefaultMainController::getMeatByCatId('err_404');

        WebMainController::printSeoMeta($Meta, null, null, array('ErrorPage' => true));
        $pageView = [
            'SelMenu' => '',
            'show_fix' => true,
            'slug' => null,
            'go_home' => route('page_index'),
        ];
        View::share('pageView', $pageView);
        View::share('meta', $Meta);

        $adminDir = config('app.configAdminDir');
        $currentSlug = Route::current()->originalParameters();

        if (isset($currentSlug['slug']) and mb_substr($currentSlug['slug'], 0, strlen($adminDir)) == $adminDir) {
            abort('410');
        } else {
            abort('404');
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCategoryMenuList
    static function CashCategoryMenuList($stopCash = 0) {
        if ($stopCash) {
            $CashCategoryMenuList = Category::defWep()->where('parent_id', null)->orderby('products_count', 'desc')->having('products_count', '>', 0)->get();
        } else {
            $CashCategoryMenuList = Cache::remember('CashCategoryMenuList', cashDay(7), function () {
                return Category::defWep()->where('parent_id', null)->orderby('products_count', 'desc')->having('products_count', '>', 0)->get();
            });
        }
        return $CashCategoryMenuList;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashBrandMenuList
    static function CashBrandMenuList($stopCash = 0) {
        if ($stopCash) {
            $CashBrandMenuList = Brand::defWep()->having('products_count', '>', 0)->orderby('products_count', 'desc')->get();
        } else {
            $CashBrandMenuList = Cache::remember('CashBrandMenuList', cashDay(7), function () {
                return Brand::defWep()->having('products_count', '>', 0)->orderby('products_count', 'desc')->get();
            });
        }
        return $CashBrandMenuList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCategoryFilterList
    static function CashCategoryFilterList($stopCash = 0) {
        if ($stopCash) {
            $CashCategoryFilterList = Category::defWep()->get();
        } else {
            $CashCategoryFilterList = Cache::remember('CashCategoryFilterList', cashDay(7), function () {
                return Category::defWep()->get();
            });
        }
        return $CashCategoryFilterList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCategoryMenuList
    static function CashProductPageInfo($stopCash = 1) {
        if (File::isFile(base_path('routes/AppPlugin/pages.php'))) {
            if ($stopCash) {
                $CashProductPageInfo = Page::whereHas('categories', function ($query) {
                    $query->where('category_id', 2);
                })
                    ->with('categories')->get()->keyBy('id');
            } else {
                $CashProductPageInfo = Cache::remember('CashProductPageInfo', cashDay(7), function () {
                    return Page::whereHas('categories', function ($query) {
                        $query->where('category_id', 2);
                    })
                        ->with('categories')->get()->keyBy('id');
                });
            }
            return $CashProductPageInfo;
        } else {
            return null;
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashAttributeValueList
    static function CashAttributeValueList($stopCash = 0) {
        if ($stopCash) {
            $CashAttributeValueList = AttributeValue::all();
        } else {
            $CashAttributeValueList = Cache::remember('CashAttributeValueList', cashDay(7), function () {
                return AttributeValue::all();
            });
        }
        return $CashAttributeValueList;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCategoryMenuList
    static function CashCategoryHomePage($stopCash = 0, $cat) {
        if ($stopCash) {
            $CashCategoryHomePage = Category::defWep()->where('parent_id', null)
                ->with('products_home')
                ->withcount('products_home')
                ->orderby('products_home_count', 'desc')
                ->having('products_home_count', '>', 0)
                ->take($cat)
                ->get();

        } else {
            $CashCategoryHomePage = Cache::remember('CashCategoryHomePage', cashDay(7), function () use ($cat) {
                return Category::defWep()->where('parent_id', null)
                    ->with('products_home')
                    ->withcount('products_home')
                    ->orderby('products_home_count', 'desc')
                    ->having('products_home_count', '>', 0)
                    ->take($cat)
                    ->get();

            });
        }
        return $CashCategoryHomePage;
    }

}
