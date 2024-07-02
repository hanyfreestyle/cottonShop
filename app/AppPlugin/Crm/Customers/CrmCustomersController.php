<?php

namespace App\AppPlugin\Crm\Customers;


use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Crm\Customers\Request\CrmCustomersRequest;

use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class CrmCustomersController extends AdminMainController {
    use CrudTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->defCountry = "om";
        View::share('defCountry', $this->defCountry);

        $this->phoneAreaCode = false;
        View::share('phoneAreaCode', $this->phoneAreaCode);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

        $this->Config = [
            'addAddress'=> true,
        ];

        View::share('Config', $this->Config);



        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0],
            'yajraTable' => true,
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
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_repeat');

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
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_list');
        $pageData['SubView'] = false;

        $session = self::getSessionData($request);
        $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);

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
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_add');


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
        $pageData['BoxH1'] = __($this->defLang . 'app_menu_edit');
        $rowData = CrmCustomers::where('id', $id)->firstOrFail();
        return view('AppPlugin.CrmCustomer.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     indexQuery
    public function indexQuery() {
        $table = "crm_customers";
        $data = DB::table($table)
            ->select("$table.id as id",
                "$table.name as name",
                "$table.mobile  as mobile",
                "$table.whatsapp as whatsapp",
                "$table.mobile_code as Flag",
            );

        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $rowData = self::CustomerDataFilterQ(self::indexQuery(), $session);
            return self::DataTableColumns($rowData)->make(true);
        }
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
                $saveData->mobile_code = $request->input('countryCode_mobile');

                $saveData->mobile_2 = $request->input('mobile_2');
                if ($request->input('mobile_2')) {
                    $saveData->mobile_2_code = $request->input('countryCode_mobile_2');
                }

                $saveData->phone = $request->input('phone');
                if ($request->input('phone')) {
                    $saveData->phone_code = $request->input('countryCode_phone');
                }

                $saveData->whatsapp = $request->input('whatsapp');
                if ($request->input('whatsapp')) {
                    $saveData->whatsapp_code = $request->input('countryCode_whatsapp');
                }

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
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function DataTableColumns($data, $arr = array()) {
        return DataTables::query($data)
            ->addIndexColumn()
            ->editColumn('Flag', function ($row) {
                return TablePhotoFlag_Code($row, 'Flag');
            })

            ->editColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->editColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(['Edit', "Delete", 'is_active', 'Flag']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function CustomerDataFilterQ($query, $session, $order = null) {
        $formName = issetArr($session, "formName", null);

        if (isset($session['is_active']) and $session['is_active'] != null) {
            $query->where('is_active', $session['is_active']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $Country =  Country::where('id',$session['country_id'])->first();
            $mobile_code = strtolower($Country->iso2);
            $query->where('mobile_code', $mobile_code);
        }

//        if (isset($session['country_id']) and $session['country_id'] != null) {
//            if ($formName == "CityFilter") {
//                $query->where('data_city.country_id', $session['country_id']);
//            }
//            if ($formName == "AreaFilter") {
//                $query->where('data_area.country_id', $session['country_id']);
//            }
//        }
//
//        if (isset($session['city_id']) and $session['city_id'] != null) {
//            if ($formName == "AreaFilter") {
//                $query->where('data_area.city_id', $session['city_id']);
//            }
//        }


        if ($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
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
        $subMenu->sel_routs = setActiveRoute("CrmCustomer");;
        $subMenu->url = "admin.CrmCustomer.index";
        $subMenu->name = "admin/crm/customers.app_menu_list";
        $subMenu->roleView = "crm_customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "CrmCustomer.addNew";
        $subMenu->url = "admin.CrmCustomer.addNew";
        $subMenu->name = "admin/crm/customers.app_menu_add";
        $subMenu->roleView = "crm_customer_add";
        $subMenu->icon = "fas fa-plus";
        $subMenu->save();
    }

}
