<?php

namespace App\AppPlugin\Orders;

use App\AppCore\Menu\AdminMenu;
use App\AppPlugin\Customers\Models\ShoppingOrderLog;
use App\AppPlugin\Orders\Models\Order;
use App\AppPlugin\Orders\Request\OrderConfirmNewRequest;
use App\AppPlugin\Orders\Request\OrderConfirmPendingRequest;
use App\Http\Controllers\AdminMainController;

use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends AdminMainController {

    use CrudTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "ShopOrders";
        $this->PrefixRole = 'orders';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/orders.app_menu');
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

        self::loadConstructData($sendArr);

        $OrdersStatusArr = [
            "1" => ['id' => '1', 'name' => __('admin/orders.from_order_status_1')],
            "2" => ['id' => '2', 'name' => __('admin/orders.from_order_status_2')],
        ];
        View::share('OrdersStatusArr', $OrdersStatusArr);

        $PendingStatusArr = [
            "1" => ['id' => '1', 'name' => __('admin/orders.from_order_pending_1')],
            "2" => ['id' => '2', 'name' => __('admin/orders.from_order_pending_2')],
        ];
        View::share('PendingStatusArr', $PendingStatusArr);

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";


        $session = self::getSessionData($request);
        if (isset($request->formName)) {
            return redirect()->back();
        }

        $status = self::getStatus();

        if ($this->viewDataTable and $this->yajraTable) {

            if ($session == null) {
                $rowData = Order::where('status', $status)->count();
            } else {
                $rowData = self::OrdersFilterQ(Order::where('status', $status), $session)->count();
            }

            return view('AppPlugin.Orders.index_DataTable')->with([
                'pageData' => $pageData,
                'OrderStatus' => $status,
                'rowData' => $rowData,
            ]);
        } else {

            if ($session == null) {
                $rowData = self::getSelectQuery(Order::where('status', $status));
            } else {
                $rowData = self::getSelectQuery(self::OrdersFilterQ(Order::where('status', $status), $session));
            }
            return view('AppPlugin.Orders.index')->with([
                'pageData' => $pageData,
                'rowData' => $rowData,
                'OrderStatus' => $status,
            ]);
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   DataTable
    public function DataTable(Request $request) {
        if ($request->ajax()) {
            $id = $request->id;
            $session = self::getSessionData($request);

            if ($session == null) {
                $data = Order::with('address')->where('status', $id);
            } else {
                $data = self::OrdersFilterQ(Order::with('address')->where('status', $id), $session);
            }
            return self::OrdersDataTableAddColumns($data)->make(true);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     OrderView
    public function OrderView($uuid) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['title'] = __('web/orders.title_view');

        $isUuid = Str::isUuid($uuid);
        if (!$isUuid) {
            abort(404);
        }

        $order = Order::query()
            ->where('uuid', $uuid)
            ->with('customer')
            ->with('products')
            ->with('address')
            ->with('orderlog')
            ->firstOrFail();

        return view('AppPlugin.Orders.view')->with([
            'pageData' => $pageData,
            'order' => $order,
        ]);


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ConfirmNew
    public function ConfirmNew(OrderConfirmNewRequest $request, $uuid) {
        $isUuid = Str::isUuid($uuid);

        if (!$isUuid) {
            abort(404);
        }

        $order = Order::query()
            ->where('uuid', $uuid)
            ->where('status', 1)
            ->firstOrFail();

        try {
            DB::transaction(function () use ($request, $order) {

                if ($request->input('order_status') == 1) {
                    $newStatus = 2;
                    $log_ref = 1;
                } elseif ($request->input('order_status') == 2) {
                    $newStatus = 4;
                    $log_ref = 3;
                }
                $order->status = $newStatus;
                $order->save();

                $addLog = new ShoppingOrderLog();
                $addLog->order_id = $order->id;
                $addLog->log_ref = $log_ref;
                $addLog->user_id = Auth::user()->id;
                $addLog->add_date = now();
                $addLog->notes = $request->input('notes');
                $addLog->save();

            });
        } catch (\Exception $exception) {
            return redirect()->back()->with('Error', __('web/order.err_order_not_saved'));
        }

        return redirect()->route('admin.ShopOrders.New.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ConfirmNew
    public function ConfirmPending(OrderConfirmPendingRequest $request, $uuid) {
        $isUuid = Str::isUuid($uuid);
        if (!$isUuid) {
            abort(404);
        }

        $order = Order::query()
            ->where('uuid', $uuid)
            ->where('status', 2)
            ->firstOrFail();

        try {
            DB::transaction(function () use ($request, $order) {
                if ($request->input('order_status') == 1) {
                    $newStatus = 3;
                    $log_ref = 2;
                    $order->delivery_date = now();
                    $order->invoice_number = $request->input('invoice_number');
                } elseif ($request->input('order_status') == 2) {
                    $order->cancellation_date = now();
                    $newStatus = 4;
                    $log_ref = 3;
                }
                $order->status = $newStatus;
                $order->save();

                $addLog = new ShoppingOrderLog();
                $addLog->order_id = $order->id;
                $addLog->log_ref = $log_ref;
                $addLog->user_id = Auth::user()->id;
                $addLog->add_date = now();
                $addLog->notes = $request->input('notes');
                $addLog->save();

            });
        } catch (\Exception $exception) {
            return redirect()->back()->with('Error', __('web/order.err_order_not_saved'));
        }

        return redirect()->route('admin.ShopOrders.New.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   OrdersFilterQ
    static function OrdersFilterQ($query, $session, $order = null) {
        $query->where('id', '!=', 0);

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('order_date', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('order_date', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['delivery_from']) and $session['delivery_from'] != null) {
            $query->whereDate('delivery_date', '>=', Carbon::createFromFormat('Y-m-d', $session['delivery_from']));
        }

        if (isset($session['delivery_to']) and $session['delivery_to'] != null) {
            $query->whereDate('delivery_date', '<=', Carbon::createFromFormat('Y-m-d', $session['delivery_to']));
        }


        if (isset($session['price_from']) and $session['price_from'] != null and intval($session['price_from']) > 0) {
            $query->where('total', ">=", $session['price_from']);
        }

        if (isset($session['price_to']) and $session['price_to'] != null and intval($session['price_to']) > 0) {
            $query->where('total', "<=", $session['price_to']);
        }


        if (isset($session['city_id']) and $session['city_id'] != null) {
            $query->where('city_id', $session['city_id']);
        }


        if ($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function OrdersDataTableAddColumns($data, $arr = array()) {

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('id', function ($row) {
                return $row->id + 1000;
            })
            ->editColumn('city', function ($row) {
                return $row->address->city;
            })
            ->editColumn('name', function ($row) {
                return $row->address->name;
            })
            ->editColumn('phone', function ($row) {
                return $row->address->phone;
            })
            ->editColumn('total', function ($row) {
                return number_format($row->total);
            })
            ->editColumn('shipping', function ($row) {
                return number_format($row->shipping);
            })
            ->editColumn('total_invoice', function ($row) {
                return number_format($row->total_invoice);
            })
            ->editColumn('order_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->order_date)),
                    'timestamp' => strtotime($row->order_date)
                ];
            })
            ->editColumn('delivery_date', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->delivery_date)),
                    'timestamp' => strtotime($row->delivery_date)
                ];
            })
            ->addColumn('view', function ($row) {
                return '<a href="' . route('admin.ShopOrders.OrderView', $row->uuid) . '" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->rawColumns(['view']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function getStatus() {
        switch (Route::currentRouteName()) {
            case "admin.ShopOrders.New.index":
                $status = 1;
                break;
            case "admin.ShopOrders.Pending.index":
                $status = 2;
                break;
            case "admin.ShopOrders.Recipient.index":
                $status = 3;
                break;
            case "admin.ShopOrders.Rejected.index":
                $status = 4;
                break;
            default:
                $status = 1;
        }
        return $status;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.ShopOrders";
        $mainMenu->name = "admin/orders.app_menu";
        $mainMenu->icon = "fas fa-money-check-alt";
        $mainMenu->roleView = "orders_view";
        $mainMenu->postion = 2;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "New.index";
        $subMenu->url = "admin.ShopOrders.New.index";
        $subMenu->name = "admin/orders.app_menu_status_1";
        $subMenu->roleView = "orders_view";
        $subMenu->icon = "fas fa-bolt";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Pending.index";
        $subMenu->url = "admin.ShopOrders.Pending.index";
        $subMenu->name = "admin/orders.app_menu_status_2";
        $subMenu->roleView = "orders_view";
        $subMenu->icon = "fas fa-wrench";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Recipient.index";
        $subMenu->url = "admin.ShopOrders.Recipient.index";
        $subMenu->name = "admin/orders.app_menu_status_3";
        $subMenu->roleView = "orders_view";
        $subMenu->icon = "fas fa-thumbs-up";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Rejected.index";
        $subMenu->url = "admin.ShopOrders.Rejected.index";
        $subMenu->name = "admin/orders.app_menu_status_4";
        $subMenu->roleView = "orders_view";
        $subMenu->icon = "fas fa-times-circle";
        $subMenu->save();

    }
}
