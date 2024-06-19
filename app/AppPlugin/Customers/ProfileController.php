<?php

namespace App\AppPlugin\Customers;

use App\AppPlugin\Customers\Models\UsersCustomers;
use App\AppPlugin\Customers\Models\UsersCustomersAddress;
use App\AppPlugin\Customers\Models\UsersCustomersWishList;
use App\AppPlugin\Customers\Request\ProfileAddressAddRequest;
use App\AppPlugin\Customers\Request\ProfileAddressEditRequest;
use App\AppPlugin\Customers\Request\ProfilePasswordUpdateRequest;
use App\AppPlugin\Customers\Request\ProfileUpdateRequest;
use App\Http\Controllers\WebMainController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class ProfileController extends WebMainController {

    public $SinglePageView;

    public function __construct() {
        parent::__construct();


        $CartContent = Cart::content();
        View::share('CartContent', $CartContent);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   Profile_ChangePassword
    public function Profile_OrdersList() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'orders';


        return view('AppPlugin.Customer.profile.orders')->with([
            'pageView' => $pageView,
            'meta' => $meta,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ProfileView
    public function ProfileView() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'accountInfo';

        $UserProfile = Auth::guard('customer')->user();
//        dd(Auth::guard('customer')->user()->last_login);

        return view('AppPlugin.Customer.profile.index')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'meta' => $meta,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ProfileUpdate
    public function ProfileUpdate(ProfileUpdateRequest $request) {
        $UserProfile = Auth::guard('customer')->user();
        $customer = UsersCustomers::def()
            ->where('id', $UserProfile->id)
            ->firstOrFail();
        try {
            DB::transaction(function () use ($customer, $request) {
                $customer->name = $request->input('name');
                $customer->email = $request->input('email');
                $customer->whatsapp = $request->input('whatsapp');
                $customer->city_id = $request->input('city_id');
                $customer->save();
            });
        } catch (\Exception $exception) {
            return back()->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('Customer_Profile')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   Profile_ChangePassword
    public function Profile_ChangePassword() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'ChangePassword';


        $oldPass = null;
        if(isset($_GET['old'])) {
            $oldPass = $_GET['old'];
        }

        return view('AppPlugin.Customer.profile.password_change')->with([
            'pageView' => $pageView,
            'meta' => $meta,
            'oldPass' => $oldPass,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   Profile_ChangePasswordUpdate
    public function Profile_ChangePasswordUpdate(ProfilePasswordUpdateRequest $request) {

        $SinglePageView = $this->SinglePageView;
        $SinglePageView['profileMenu'] = "ChangePassword";
        $hashedPassword = Auth::guard('customer')->user()->password;
        if(Hash::check($request->input('old_password'), $hashedPassword)) {
            $UserProfile = Auth::guard('customer')->user();
            $customer = UsersCustomers::query()
                ->where('id', $UserProfile->id)
                ->where('status', 1)
                ->where('is_active', 1)
                ->firstOrFail();
            $customer->password = Hash::make($request->input('password'));
            $customer->password_temp = null;
            $customer->save();
            Auth::guard('customer')->logout();
            return redirect()->route('Customer_login');
        } else {
            return redirect()->back()->with('Error', __('web/profileMass.pass_not_match'));
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   Profile_Address_List
    public function Profile_Address_List() {

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $customer = UsersCustomers::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->with('addresses')
            ->firstOrFail();

        return view('AppPlugin.Customer.profile.address_list')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'meta' => $meta,
            'customer' => $customer,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Profile_Address_Add
    public function Profile_Address_Add() {
        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $customer = UsersCustomers::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->with('addresses')
            ->firstOrFail();

        if($customer->addresses_count < 4) {
            return view('AppPlugin.Customer.profile.address_form')->with([
                'pageView' => $pageView,
                'meta' => $meta,
                'UserProfile' => $UserProfile,
                'customer' => $customer,
            ]);
        } else {
            return view('AppPlugin.Customer.profile.address_list')->with([
                'pageView' => $pageView,
                'meta' => $meta,
                'UserProfile' => $UserProfile,
                'customer' => $customer,
            ]);
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Profile_Address_Save
    public function Profile_Address_Save(ProfileAddressAddRequest $request) {
        $SinglePageView = $this->SinglePageView;
        $SinglePageView['profileMenu'] = "profile";

        $UserProfile = Auth::guard('customer')->user();
        $customer = UsersCustomers::def()
            ->where('id', $UserProfile->id)
            ->withCount('addresses')
            ->firstOrFail();

        if($customer->addresses_count < 4) {
            try {
                DB::transaction(function () use ($customer, $request) {

                    $saveAddress = new UsersCustomersAddress;

                    if($customer->addresses_count == 0) {
                        $saveAddress->is_default = true;
                        $saveAddress->name = __('web/profile.address_text_def_adress');
                    } else {
                        $saveAddress->name = __('web/profile.address_text_def_adress_name') . " " . $customer->addresses_count + 1;
                    }
                    $saveAddress->uuid = Str::uuid()->toString();
                    $saveAddress->customer_id = $customer->id;

                    $saveAddress->city_id = $request->input('city_id');
                    $saveAddress->recipient_name = $request->input('recipient_name');

                    $saveAddress->phone = $request->input('phone');
                    $saveAddress->phone_option = $request->input('phone_option');
                    $saveAddress->address = $request->input('address');
                    $saveAddress->save();
                });
            } catch (\Exception $exception) {
                return back()->with(['ExceptionNotSave' => '']);
            }

            if($request->input('page_type') == 'orders') {
                return redirect()->route('Shop_CartConfirm');
            } else {
                return redirect()->route('Profile_Address')->with('UpdateDone', "");
            }
        } else {
            return back()->with(['ExceptionNotSave' => 'ssssssssssssssssss']);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Profile_Address_Edit
    public function Profile_Address_Edit($uuid) {
        $isUuid = Str::isUuid($uuid);
        if(!$isUuid) {
            Auth::guard('customer')->logout();
            return redirect()->route('Customer_login');
        }

        $meta = parent::getMeatByCatId('profile_page');
        parent::printSeoMeta($meta, 'page_index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'profile_page';
        $pageView['page'] = 'login_page';
        $pageView['profileMenu'] = 'AddressInfo';

        $UserProfile = Auth::guard('customer')->user();

        $address = UsersCustomersAddress::query()
            ->where('uuid', $uuid)
            ->where('customer_id', $UserProfile->id)
            ->firstOrFail();

        return view('AppPlugin.Customer.profile.address_form_edit')->with([
            'pageView' => $pageView,
            'UserProfile' => $UserProfile,
            'address' => $address,
            'meta' => $meta,
        ]);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Profile_Address_Update
    public function Profile_Address_Update(ProfileAddressEditRequest $request, $uuid) {
        $isUuid = Str::isUuid($uuid);

        if(!$isUuid) {
            Auth::guard('customer')->logout();
            return redirect()->route('Customer_login');
        }

        $UserProfile = Auth::guard('customer')->user();
        $address = UsersCustomersAddress::query()
            ->where('uuid', $uuid)
            ->where('customer_id', $UserProfile->id)
            ->firstOrFail();

        try {
            DB::transaction(function () use ($address, $request) {
                $address->name = $request->input('name');
                $address->city_id = $request->input('city_id');
                $address->recipient_name = $request->input('recipient_name');
                $address->phone = $request->input('phone');
                $address->phone_option = $request->input('phone_option');
                $address->address = $request->input('address');
                $address->save();
            });
        } catch (\Exception $exception) {
            return redirect()->route('Profile_Address')->with(['ExceptionNotSave' => '']);
        }
        return redirect()->route('Profile_Address')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Profile_Address_UpdateDefault
    public function Profile_Address_UpdateDefault($uuid) {
        $UserProfile = Auth::guard('customer')->user();

        $all_Address = UsersCustomersAddress::query()
            ->where('customer_id', $UserProfile->id)
            ->get();

        if(count($all_Address) > 0) {
            foreach ($all_Address as $address) {
                if($address->uuid == $uuid) {
                    $address->is_default = true;
                } else {
                    $address->is_default = false;
                }
                $address->save();
            }
        }
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   WishlistDelete
    public function WishlistDelete() {
        Cart::instance('wishlist')->destroy();
        return redirect()->route('page_WishList')->with('UpdateDone', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   WishlistDelete
    public function WishlistSave() {
        $wishlistCart = Cart::instance('wishlist')->content();
        $UserProfile = Auth::guard('customer')->user();

        foreach ($wishlistCart as $cart) {
            $saveData = UsersCustomersWishList::where('customer_id', $UserProfile->id)
                ->where('product_id', $cart->id)->firstOrNew();
            $saveData->customer_id = $UserProfile->id;
            $saveData->product_id = $cart->id;
            $saveData->save();
        }

        Cart::instance('wishlist')->destroy();
        return redirect()->route('page_WishList')->with('UpdateDone', "");
    }


    /*
    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     Profile_OrdersList
        public function Profile_OrdersList() {
            $SinglePageView = $this->SinglePageView;
            $SinglePageView['profileMenu'] = "OrdersList";
            $SinglePageView['breadcrumb'] = "OrdersList";

            $UserProfile = Auth::guard('customer')->user();

            $orders = ShoppingOrder::query()
                ->where('customer_id', $UserProfile->id)
                ->orderBy('order_date', 'desc')
                ->paginate(12);
            return view('shop.customer.profile_order_list', compact('SinglePageView', 'UserProfile', 'orders')
            );
        }

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     Profile_MyProduct
        public function Profile_MyProduct() {
            $SinglePageView = $this->SinglePageView;
            $SinglePageView['profileMenu'] = "ProfileMyProduct";
            $SinglePageView['breadcrumb'] = "ProfileMyProduct";
            $SinglePageView['SelMenu'] = "ProfileMyProduct";

            $UserProfile = Auth::guard('customer')->user();

            if($this->agent->isMobile() == true and $this->agent->isTablet() == false) {
                $proViewList = 'list';
            } else {
                $proViewList = '';
            }

            $customersProduct = UserCustomersProduct::select('product_id')
                ->where('customer_id', $UserProfile->id)
                ->pluck('product_id');


            $FavProducts = Product::query()
                ->where('is_active', true)
                ->where('is_archived', false)
                ->where('pro_shop', true)
                ->whereIn('id', $customersProduct)
                ->withAggregate('category', 'category_id')
                ->orderBy('category_category_id')
                ->paginate(12);

            return view('shop.customer.profile_my_product',
                compact('SinglePageView', 'UserProfile', 'FavProducts', 'proViewList')
            );
        }

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     Profile_OrderView
        public function Profile_OrderView($uuid) {
            $isUuid = Str::isUuid($uuid);
            if(!$isUuid) {
                Auth::guard('customer')->logout();
                return redirect()->route('Customer_login');
            }

            $SinglePageView = $this->SinglePageView;
            $SinglePageView['profileMenu'] = "OrdersList";
            $SinglePageView['breadcrumb'] = "OrdersList";

            $UserProfile = Auth::guard('customer')->user();
            $order = ShoppingOrder::query()
                ->where('uuid', $uuid)
                ->where('customer_id', $UserProfile->id)
                ->with('products')
                ->with('log')
                ->firstOrFail();
            return view('shop.customer.profile_order_view', compact('SinglePageView', 'UserProfile', 'order'));

        }

    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| #     Profile_OrderCancellation
        public function Profile_OrderCancellation($uuid) {
            $isUuid = Str::isUuid($uuid);
            if(!$isUuid) {
                Auth::guard('customer')->logout();
                return redirect()->route('Customer_login');
            }

            $SinglePageView = $this->SinglePageView;
            $SinglePageView['profileMenu'] = "OrdersList";
            $SinglePageView['breadcrumb'] = "OrdersList";

            $UserProfile = Auth::guard('customer')->user();
            $order = ShoppingOrder::query()
                ->where('uuid', $uuid)
                ->where('status', 1)
                ->where('customer_id', $UserProfile->id)
                ->with('products')
                ->with('log')
                ->firstOrFail();

            return view('shop.customer.profile_order_cancellation', compact('SinglePageView', 'UserProfile', 'order'));

        }


    #@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    #|||||||||||||||||||||||||||||||||||||| # Profile_CancellationConfirm

        public function Profile_CancellationConfirm(CancellationConfirmRequest $request, $uuid) {
            $isUuid = Str::isUuid($uuid);
            if(!$isUuid) {
                Auth::guard('customer')->logout();
                return redirect()->route('Customer_login');
            }

            $UserProfile = Auth::guard('customer')->user();
            $order = ShoppingOrder::query()
                ->where('uuid', $uuid)
                ->where('status', 1)
                ->where('customer_id', $UserProfile->id)
                ->with('products')
                ->with('log')
                ->firstOrFail();

            $order->cancellation_date = now();
            $order->cancellation_notes = $request->input('notes');
            $order->status = 5;
            $order->save();

            return redirect()->route('Profile_OrdersList');

        }
    */

}
