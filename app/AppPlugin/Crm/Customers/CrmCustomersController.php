<?php

namespace App\AppPlugin\Crm\Customers;


use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersRequest;
use App\Http\Controllers\AdminMainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class CrmCustomersController extends AdminMainController {


    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 1],
            'yajraTable' => false,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "AreaFilter",
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function repeat($value) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang.'app_menu_repeat');

        $rowData = CrmCustomers::def()->where('mobile', $value)->orWhere('mobile_2', $value)
            ->orWhere('phone', $value)->orWhere('whatsapp', $value)->get();

        return view('AppPlugin.CrmCustomer.index_repeat')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['BoxH1'] = __($this->defLang.'app_menu_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);

        if ($session == null) {
            $rowData = self::getSelectQuery(CrmCustomers::def());
        } else {
            $rowData = self::getSelectQuery(self::ManageDataFilterQ(CrmCustomers::def(), $session));
        }

        return view('AppPlugin.CrmCustomer.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['BoxH1'] = __($this->defLang.'app_menu_add');


        $rowData = CrmCustomers::findOrNew(0);

        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $pageData['BoxH1'] = __($this->defLang.'app_menu_edit');
        $rowData = CrmCustomers::where('id', $id)->firstOrFail();
        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(CrmCustomersRequest $request, $id = 0) {
        $saveData = CrmCustomers::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->name = $request->input('name');
                $saveData->mobile = $request->input('mobile');
                $saveData->mobile_2 = $request->input('mobile_2');
                $saveData->phone = $request->input('phone');
                $saveData->whatsapp = $request->input('whatsapp');
                $saveData->email = $request->input('email');
                $saveData->notes = $request->input('notes');
                $saveData->save();

            });

        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.CrmCustomer";
        $mainMenu->name = "admin/crm/customers.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "crm_customer_view";
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.index";
        $subMenu->url = "admin.CrmCustomer.index";
        $subMenu->name =  "admin/crm/customers.app_menu_list";
        $subMenu->roleView =  "crm_customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.create";
        $subMenu->url = "admin.CrmCustomer.create";
        $subMenu->name =  "admin/crm/customers.app_menu_add";
        $subMenu->roleView = "crm_customer_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();
    }


//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # CustomerLogin
//    public function CustomerLogin($cart = '') {
//
//        $meta = parent::getMeatByCatId('login');
//        parent::printSeoMeta($meta, 'page_index');
//
//        $pageView = $this->pageView;
//        $pageView['SelMenu'] = 'profile_page';
//        $pageView['page'] = 'login_page';
//
//        return view('AppPlugin.Customer.auth.login')->with([
//            'pageView' => $pageView,
//            'cart' => $cart,
//            'meta' => $meta,
//        ]);
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #  CustomerLoginCheck
//    public function CustomerLoginCheck(UsersCustomersRequest $request, $Cart = null) {
//        $credentials = array_merge($request->only('phone', "password"), ['is_active' => 1]);
//        if(Auth::guard('customer')->attempt($credentials)) {
//            $user = UsersCustomers::find(Auth::guard('customer')->user()->id);
//            $user->last_login = now();
//            $user->password_temp =null;
//            $user->save();
//            return redirect()->back();
//        } else {
//            return redirect()->route('Customer_login')->with('Error',__('web/profileMass.login_err'));
//        }
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # CustomerLogout
//    public function CustomerLogout() {
//        Auth::guard('customer')->logout();
//        return redirect()->route('page_index');
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| # CustomerSignUp
//    public function CustomerSignUp() {
//
//        $meta = parent::getMeatByCatId('sign_up');
//        parent::printSeoMeta($meta, 'page_index');
//
//        $pageView = $this->pageView;
//        $pageView['SelMenu'] = 'profile_page';
//        $pageView['page'] = 'login_page';
//
//        return view('AppPlugin.Customer.auth.register')->with([
//            'pageView' => $pageView,
//            'meta' => $meta,
//        ]);
//
//    }
//
//#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//#|||||||||||||||||||||||||||||||||||||| #     CustomerCreate
//    public function CustomerCreate(UsersCustomerSignUpRequest $request) {
//
//        $user = new UsersCustomers();
//
//        $user->name = $request->input('name');
//        $user->email = $request->input('email');
//        $user->phone = $request->input('phone');
//        $user->password = \Hash::make($request->password);
//        $user->last_login = now();
//        $user->save();
//
//        try {
//            $user->save();
//            Auth::guard('customer')->login($user);
//
//        } catch (\Exception $e) {
//            $err = $e->getMessage();
//            return redirect()->back()->with('err', "dddddd");
//
//        }
//        return redirect()->route('Customer_Profile');
//    }



}
