<?php

namespace App\AppPlugin\Config\SiteMap;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;


class SiteMapController extends AdminMainController {
    function __construct() {

        parent::__construct();
        $this->controllerName = "SiteMap";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = 'Site Maps';
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, 'selectfilterid' => 0, "orderby" => 0],
            'yajraTable' => true,
            'AddButToCard' => false,
            'restore' => 1,
            'formName' => "ShopOrdersFilters",
        ];


        $this->config = [
            'singlePage' => true,
            'addAlternate' => false,
            'addPhoto' => true,
            'langAr' => true,
            'langEn' => false,
        ];
        View::share('Config', $this->config);


        self::loadConstructData($sendArr);

        $this->middleware('permission:sitemap_view', ['only' => ['index']]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # index
    public function index() {
        $rowData = SiteMap::get()->keyBy('cat_id');
        return view('AppPlugin.ConfigSiteMap.index', compact('rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateSiteMap() {
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', false);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);

        if ($this->config['singlePage']) {
            $xmlFileName = public_path('sitemap.xml');
            $fh = fopen($xmlFileName, 'w') or die("can't open file");
            $stringData = $siteMapTools->XML_HeaderSinglePage();
        } else {
            $stringData = "";
        }

        $stringData .= self::UpdateIndexPages('index');
        $stringData .= self::UpdateBlogPages('blog');

        if ($this->config['singlePage']) {
            $stringData .= "</urlset>\n";
            fwrite($fh, $stringData);
            fclose($fh);
        }

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateIndexPages($catId) {
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', false);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);


        if (!$this->config['singlePage']) {
            SiteMapTools::updateIndexSiteOneFile($catId);
            $xmlFileList = SiteMap::where('cat_id', $catId)->firstOrFail();
            $xmlFileName = public_path($xmlFileList->name);

            $fh = fopen($xmlFileName, 'w') or die("can't open file");
            $stringData = $siteMapTools->XML_Header();
        } else {
            $stringData = "";
        }

        foreach (config('app.web_lang') as $key => $lang) {
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_index');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_AboutUs');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_Trems');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_WishList');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_AboutUs');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_ContactUs');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_ShopView');
            $stringData .= $siteMapTools->AddSinglePage($key, 'page_Offers');
        }

        if (!$this->config['singlePage']) {
            $stringData .= "</urlset>\n";
            fwrite($fh, $stringData);
            fclose($fh);
        } else {
            return $stringData;
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateBlogPages($catId) {
        $siteMapTools = new SiteMapTools();
        $siteMapTools->addAlternate = IsArr($this->config, 'addAlternate', false);
        $siteMapTools->addPhoto = IsArr($this->config, 'addPhoto', true);
        $siteMapTools->langAr = IsArr($this->config, 'langAr', false);
        $siteMapTools->langEn = IsArr($this->config, 'langEn', false);
        if (File::isFile(base_path('routes/AppPlugin/blogPost.php'))) {

            if (!$this->config['singlePage']) {
                SiteMapTools::updateIndexSiteOneFile($catId);
                $xmlFileList = SiteMap::where('cat_id', $catId)->firstOrFail();
                $xmlFileName = public_path($xmlFileList->name);
                $fh = fopen($xmlFileName, 'w') or die("can't open file");
                $stringData = $siteMapTools->XML_Header();
            } else {
                $stringData = "";
            }

            $dataRows = BlogCategory::orderBy('id')
                ->where('is_active', true)

                ->get();

            $siteMapTools->urlRoute = "BlogCategoryView";
            $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);

            foreach (config('app.web_lang') as $key => $lang) {
                $stringData .= $siteMapTools->AddSinglePage($key, 'BlogList');
            }

            $dataRows = Blog::orderBy('id')
                ->where('is_active', true)
                ->take(300)
                ->get();

            $siteMapTools->urlRoute = "BlogView";
            $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);

            if (!$this->config['singlePage']) {
                $stringData .= "</urlset>\n";
                fwrite($fh, $stringData);
                fclose($fh);
            } else {
                return $stringData;
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateProducts(Request $request) {

        $cat_id = $request->input('cat_id');
        SiteMapTools::updateIndexSiteOneFile($cat_id);
        $xmlFileList = SiteMap::where('cat_id', $cat_id)->firstOrFail();
        $xmlFileName = public_path($xmlFileList->name);

        $siteMapTools = new SiteMapTools();
        $siteMapTools->urlRoute = "ProductsCategoriesView";
        $siteMapTools->langAr = true;
        $siteMapTools->langEn = false;
        $siteMapTools->addAlternate = false;
        $siteMapTools->addPhoto = true;

        $fh = fopen($xmlFileName, 'w') or die("can't open file");
        $stringData = $siteMapTools->XML_Header();

        $dataRows = Category::orderBy('id')
            ->where('is_active', true)
            ->get();
        $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);


        $dataRows = Brand::orderBy('id')
            ->where('is_active', true)
            ->get();

        $siteMapTools->urlRoute = "BrandView";
        $stringData .= $siteMapTools->Create_XML_Code_new($dataRows);


        $dataRows = Product::orderBy('id')
            ->where('parent_id', null)
            ->where('is_active', true)
            ->get();

        $siteMapTools->urlRoute = "ProductView";
        $siteMapTools->dataRows = $dataRows;
        $stringData .= $siteMapTools->Create_XML_Code();

        $stringData .= "</urlset>\n";
        fwrite($fh, $stringData);
        fclose($fh);

        SiteMapTools::updateIndexSiteMapXmlFile();
        return redirect()->back();
    }



//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function UpdateDeveloper(Request $request) {
//
//        $cat_id = $request->input('cat_id');
//        $siteMap_PerFile = '500';
//        $countTable = Developer::where('is_active', true)->count();
//
//        SiteMapTools::updateIndexSiteMapTable($cat_id, $siteMap_PerFile, $countTable);
//        $xmlFileList = SiteMap::where('cat_id', $cat_id)->get()->toArray();
//
//        if(count($xmlFileList) > 0) {
//            for ($i = 0; $i < count($xmlFileList); $i++) {
//                $xmlFileName = public_path($xmlFileList[$i]['name']);
//
//                if($i == '0') {
//                    $EndTo = $siteMap_PerFile;
//                    $dataRows = Developer::orderBy('id')
//                        ->with('tablename')
//                        ->limit($EndTo)
//                        ->get();
//                } else {
//                    $StartFrom = $i * $siteMap_PerFile;
//                    $EndTo = $siteMap_PerFile;
//                    $dataRows = Developer::orderBy('id')
//                        ->with('tablename')
//                        ->offset($StartFrom)
//                        ->limit($EndTo)
//                        ->get();
//                }
//
//                $siteMapTools = new SiteMapTools();
//                $siteMapTools->xmlFileName = $xmlFileName;
//                $siteMapTools->dataRows = $dataRows;
//                $siteMapTools->urlRoute = "page_developer_view";
//                $siteMapTools->langAr = true;
//                $siteMapTools->langEn = true;
//                $siteMapTools->addAlternate = true;
//                $siteMapTools->Create_XML_File();
//
//            }
//        }
//
//        SiteMapTools::updateIndexSiteMapXmlFile();
//        return redirect()->back();
//    }

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function UpdateListing(Request $request) {
//        ini_set('max_execution_time', 0);
//        $cat_id = $request->input('cat_id');
//        $siteMap_PerFile = '15000';
//        $countTable = Listing::where('is_published', true)->count();
//
//        SiteMapTools::updateIndexSiteMapTable($cat_id, $siteMap_PerFile, $countTable);
//        $xmlFileList = SiteMap::where('cat_id', $cat_id)->get()->toArray();
//        if(count($xmlFileList) > 0) {
//            for ($i = 0; $i < count($xmlFileList); $i++) {
//                $xmlFileName = public_path($xmlFileList[$i]['name']);
//
//                if($i == '0') {
//                    $EndTo = $siteMap_PerFile;
//                    $dataRows = Listing::orderBy('id')
//                        ->with('tablename')
//
//                        ->limit($EndTo)
//                        ->get();
//                } else {
//                    $StartFrom = $i * $siteMap_PerFile;
//                    $EndTo = $siteMap_PerFile;
//                    $dataRows = Listing::orderBy('id')
//                        ->with('tablename')
//
//                        ->offset($StartFrom)
//                        ->limit($EndTo)
//                        ->get();
//                }
//
//                $siteMapTools = new SiteMapTools();
//                $siteMapTools->xmlFileName = $xmlFileName;
//                $siteMapTools->dataRows = $dataRows;
//                $siteMapTools->urlRoute = "page_ListView";
//                if(Route::currentRouteName() == 'config.SiteMap.UpdateListingAr') {
//                    $siteMapTools->langAr = true;
//                }
//                if(Route::currentRouteName() == 'config.SiteMap.UpdateListingEn') {
//                    $siteMapTools->langEn = true;
//                }
//                $siteMapTools->addAlternate = true;
//                $siteMapTools->Create_XML_File();
//            }
//        }
//
//        SiteMapTools::updateIndexSiteMapXmlFile();
//        return redirect()->back();
//    }
//

//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
//    public function UpdateForSale(Request $request) {
//        $cat_id = $request->input('cat_id');
//        SiteMapTools::updateIndexSiteOneFile($cat_id);
//        $xmlFileList = SiteMap::where('cat_id', $cat_id)->firstOrFail();
//        $xmlFileName = public_path($xmlFileList->name);
//
//        $siteMapTools = new SiteMapTools();
//
//
//        $dataRows = Page::orderBy('id')
//            ->where('is_active', true)
//            ->get();
//
//        $fh = fopen($xmlFileName, 'w') or die("can't open file");
//        $stringData = $siteMapTools->XML_Header();
//        $stringData .= $siteMapTools->ForSaleCode($dataRows, "en", 'ar');
//        $stringData .= $siteMapTools->ForSaleCode($dataRows, "ar", 'en');
//
//        $stringData .= "</urlset>\n";
//        fwrite($fh, $stringData);
//        fclose($fh);
//
//        SiteMapTools::updateIndexSiteMapXmlFile();
//        return redirect()->back();
//
//    }


}
















