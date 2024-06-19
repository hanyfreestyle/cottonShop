<?php

namespace App\AppPlugin\Customers;

use App\AppPlugin\Customers\Models\UsersCustomers;
use App\AppPlugin\Customers\Request\UsersCustomerSignUpRequest;
use App\AppPlugin\Customers\Request\UsersCustomersRequest;
use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;



class UsersCustomersController extends WebMainController {
    public $SinglePageView;

    public function __construct() {
        parent::__construct();
//        $stopCash = 0;
//        $ShopMenuCategory = self::getShopMenuCategory($stopCash);
//        View::share('ShopMenuCategory', $ShopMenuCategory);
//
//
//        $SinglePageView = [
//            'SelMenu' => 'CustomerProfile',
//            'slug' => null,
//            'banner_id' => null,
//            'breadcrumb' => 'home',
//
//        ];
//
//        $this->SinglePageView = $SinglePageView;



    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CustomerLogin
    public function CustomerLogin($cart = '') {

        $meta = parent::getMeatByCatId('login');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';

        return view('AppPlugin.Customer.auth.login')->with([
            'pageView' => $pageView,
            'cart' => $cart,
            'meta' => $meta,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  CustomerLoginCheck
    public function CustomerLoginCheck(UsersCustomersRequest $request, $Cart = null) {
        $credentials = array_merge($request->only('phone', "password"), ['is_active' => 1]);
        if(Auth::guard('customer')->attempt($credentials)) {
            $user = UsersCustomers::find(Auth::guard('customer')->user()->id);
            $user->last_login = now();
            $user->password_temp =null;
            $user->save();
            return redirect()->back();
        } else {
            return redirect()->route('Customer_login')->with('Error',__('web/profileMass.login_err'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CustomerLogout
    public function CustomerLogout() {
        Auth::guard('customer')->logout();
        return redirect()->route('page_index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CustomerSignUp
    public function CustomerSignUp() {

        $meta = parent::getMeatByCatId('sign_up');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';

        return view('AppPlugin.Customer.auth.register')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CustomerCreate
    public function CustomerCreate(UsersCustomerSignUpRequest $request) {

        $user = new UsersCustomers();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = \Hash::make($request->password);
        $user->last_login = now();
        $user->save();

        try {
            $user->save();
            Auth::guard('customer')->login($user);

        } catch (\Exception $e) {
            $err = $e->getMessage();
            return redirect()->back()->with('err', "dddddd");

        }
        return redirect()->route('Customer_Profile');
    }


}
