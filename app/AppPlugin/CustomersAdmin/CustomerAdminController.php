<?php

namespace App\AppPlugin\CustomersAdmin;


use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Customers\Models\UsersCustomers;
use App\AppPlugin\CustomersAdmin\Request\CustomerStoreRequest;
use App\AppPlugin\Orders\Models\Order;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class CustomerAdminController extends AdminMainController {

    use CrudTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "ShopCustomer";
        $this->PrefixRole = 'customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/customer.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, 'selectfilterid' => 0, "orderby" => 0],
            'yajraTable' => true,
//            'AddButToCard' => false,
            'restore' => 1,
            'formName' => "ShopOrdersFilters",
        ];

        self::loadConstructData($sendArr);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = UsersCustomers::onlyTrashed()->count();

        if($this->viewDataTable and $this->yajraTable) {
            return view('AppPlugin.CustomerAdmin.index_DataTable')->with([
                'pageData' => $pageData
            ]);
        } else {
            $rowData = self::getSelectQuery(UsersCustomers::defAdmin());
            return view('AppPlugin.CustomerAdmin.index')->with([
                'pageData' => $pageData,
                'rowData' => $rowData,
            ]);
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if($request->ajax()) {

            $data = UsersCustomers::defAdmin();
            return self::UsersDataTableAddColumns($data)->make(true);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  UsersDataTableAddColumns
    public function UsersDataTableAddColumns($data, $arr = array()) {

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return $row->id;
            })
            ->editColumn('created_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->created_at)),
                    'timestamp' => strtotime($row->created_at)
                ];
            })

            ->editColumn('city', function ($row) {
                return $row->city->name ?? '';
            })

            ->addColumn('is_active', function ($row) {
                return is_active($row->is_active);
            })

            ->addColumn('Password', function ($row) {
                return view('datatable.but')->with(['btype' => 'Password', 'row' => $row])->render();
            })

            ->addColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })

            ->addColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })


            ->rawColumns(['is_active','Edit','Delete','Password']);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";

        $rowData = self::getSelectQuery(UsersCustomers::onlyTrashed());
        return view('AppPlugin.CustomerAdmin.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = UsersCustomers::findOrNew(0);
        return view('AppPlugin.CustomerAdmin.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".store",
        ]);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = UsersCustomers::findOrFail($id);
        return view('AppPlugin.CustomerAdmin.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".update",
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    store
    public function store(CustomerStoreRequest $request) {
        $password_temp = $request->input('phone') . '@' . rand(5000, 9999);
        $saveData = new UsersCustomers();
        $saveData->is_active = intval((bool)$request->input('is_active'));
        $saveData->name = $request->input('name');
        $saveData->city_id = $request->input('city_id');
        $saveData->phone = $request->input('phone');
        $saveData->email = $request->input('email');
        $saveData->whatsapp = $request->input('whatsapp');
        $saveData->password_temp = $password_temp;
        $saveData->password = Hash::make($password_temp);

        $saveData->save();
        return self::redirectWhere($request, $saveData->id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     update
    public function update(CustomerStoreRequest $request, $id) {

        $saveData = UsersCustomers::findOrFail($id);
        $saveData->is_active = intval((bool)$request->input('is_active'));

        $saveData->name = $request->input('name');
        $saveData->city_id = $request->input('city_id');
        $saveData->phone = $request->input('phone');
        $saveData->email = $request->input('email');
        $saveData->whatsapp = $request->input('whatsapp');
        $saveData->save();
        return self::redirectWhere($request, $saveData->id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Password
    public function Password($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = UsersCustomers::findOrFail($id);
        return view('AppPlugin.CustomerAdmin.form_pass')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'route' => ".update",
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Password_Update
    public function Password_Update($id, Request $request) {
        $request->validate([
            'password' => "required|min:8|confirmed",
        ]);

        $customer = UsersCustomers::findOrFail($id);
        $customer->password_temp = $request->input('password');
        $customer->password = Hash::make($request->input('password'));
        $customer->save();
        return self::redirectWhere($request, $customer->id, $this->PrefixRoute . '.index');

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = UsersCustomers::findOrFail($id);
        $deleteRow->delete();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     Restore
    public function restored($id) {
        UsersCustomers::onlyTrashed()->where('id', $id)->restore();
        return back()->with('restore', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ForceDeletes
    public function ForceDeletes($id) {
        $deleteRow = UsersCustomers::onlyTrashed()->where('id', $id)->firstOrFail();
        $deleteRow->forceDelete();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.ShopCustomer";
        $mainMenu->name = "admin/customer.app_menu";
        $mainMenu->icon = "fas fa-user-tie";
        $mainMenu->roleView = "customer_view";
        $mainMenu->postion = 3;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "ShopCustomer.index";
        $subMenu->url = "admin.ShopCustomer.index";
        $subMenu->name = "admin/customer.app_menu_list";
        $subMenu->roleView = "customer_view";
        $subMenu->icon = "fas fa-list";
        $subMenu->save();



    }

}
