<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\Config\Privacy\WebPrivacy;
use App\AppPlugin\Leads\ContactUs\ContactUsForm;
use App\AppPlugin\Leads\ContactUs\ContactUsFormRequest;
use App\AppPlugin\Pages\Models\Page;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;


class PagesViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function index() {

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';
        $pageView['page'] = 'page_index';

        $latestBlog = Blog::def()->take(6)->orderby('published_at', 'desc')->get();
        $homeCategory = self::CashCategoryHomePage(0, 5);

        return view('web.index')->with([
            'pageView' => $pageView,
            'latestBlog' => $latestBlog,
            'homeCategory' => $homeCategory,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function AboutUs() {
        $meta = parent::getMeatByCatId('about');
        parent::printSeoMeta($meta, 'page_AboutUs');

        $page = Page::where('id', $this->WebConfig->page_about)->firstOrFail();

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'AboutUs';

        return view('web.pages.about')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'page' => $page,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Trems() {
        $meta = parent::getMeatByCatId('trems');
        parent::printSeoMeta($meta, "page_Trems");

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'page_Trems';
        $pageView['page'] = 'page_Trems';
        $webPrivacy = WebPrivacy::where('is_active', true)->orderby('postion', 'asc')->with('translation')->get();

        return view('web.pages.trems')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'webPrivacy' => $webPrivacy,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function WishList() {
        $meta = parent::getMeatByCatId('wish_list');
        parent::printSeoMeta($meta, 'page_WishList');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'offers';
        $pageView['profileMenu'] = 'wish_list';
        $pageView['page'] = 'offers';

        return view('web.pages.wish-list')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Search() {
        $meta = parent::getMeatByCatId('search');
        parent::printSeoMeta($meta, 'page_search');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'serach_page';
        $pageView['page'] = 'serach_page';

        return view('web.pages.serach')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ContactUs() {
        $meta = parent::getMeatByCatId('contact');
        parent::printSeoMeta($meta, 'page_ContactUs');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'contact';
        $pageView['page'] = 'contact';

        return view('web.pages.contact')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ContactSaveForm(ContactUsFormRequest $request) {

        $saveContactUs = new ContactUsForm();
        $saveContactUs->name = $request->input('name');
        $saveContactUs->phone = $request->input('phone');
        if ($request->input('countryCode_phone') == 'eg') {
            $saveContactUs->full_number = "+2" . $request->input('phone');
        } else {
            $saveContactUs->full_number = "+" . $request->input('countryDialCode_phone') . $request->input('phone');
        }
        $saveContactUs->country = strtoupper($request->input('countryCode_phone'));
        $saveContactUs->subject = $request->input('subject');
        $saveContactUs->message = $request->input('message');
        $saveContactUs->request_type = $request->input('request_type');
        $saveContactUs->save();
        return redirect()->route('ContactUsThanksPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function ContactUsThanksPage() {
        $meta = parent::getMeatByCatId('contact');
        parent::printSeoMeta($meta, 'ContactUsThanksPage');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'contact';
        $pageView['page'] = 'contact';

        return view('web.pages.contact_thanks')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UnderConstruction() {
        $config = WebMainController::getWebConfig(0);
        if ($config->web_status == 1 or Auth::check()) {
            return redirect()->route('page_index');
        }
        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        return view('under');
    }
}
