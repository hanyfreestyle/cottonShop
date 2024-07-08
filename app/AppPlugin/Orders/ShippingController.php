<?php

namespace App\AppPlugin\Orders;


use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Orders\Models\ShippingCity;
use App\AppPlugin\Orders\Models\ShippingRates;
use App\AppPlugin\Orders\Request\ShippingRateRequest;
use App\AppPlugin\Orders\Request\ShippingRequest;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ShippingController extends AdminMainController {

    use CrudTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "Shipping";
        $this->PrefixRole = 'orders';
        $this->selMenu = "admin.ShopOrders.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/orders.app_menu_shipping');
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
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $rowData = ShippingCity::all();
        $cashCityList = self::CashCityList();

        return view('AppPlugin.Orders.shipping.index')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'cashCityList' => $cashCityList,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   add
    public function createList() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $allCity = ShippingCity::query()->get();
        $allCityids = [];
        foreach ($allCity as $selCity) {
            $allCityids = array_merge_recursive($allCityids, json_decode($selCity->city_id, true));
        }
        $rowData = ShippingCity::findOrnew(0);
        $CityList = City::query()->where('country_id', 66)->whereNotIn('id', $allCityids)->get();
        return view('AppPlugin.Orders.shipping.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'CityList' => $CityList,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   add
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = ShippingCity::findOrFail($id);

        $allCity = ShippingCity::query()->where('id', '!=', $id)->get();
        $allCityids = [];
        foreach ($allCity as $selCity) {
            $allCityids = array_merge_recursive($allCityids, json_decode($selCity->city_id, true));
        }
        $CityList = City::query()->where('country_id', 66)->whereNotIn('id', $allCityids)->get();
        return view('AppPlugin.Orders.shipping.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'CityList' => $CityList,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(ShippingRequest $request, $id = 0) {

        $saveData = ShippingCity::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->is_active = intval((bool)$request->input('is_active'));
                $saveData->name = $request->input('name');
                $saveData->city_id = json_encode($request->input('city_id'));
                $saveData->save();

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = ShippingCity::where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ratesIndex($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $rowData = ShippingCity::query()->where('id', $id)->with('rates')->firstOrFail();
        $CityList = City::query()->where('country_id', 66)->get();


        return view('AppPlugin.Orders.shipping.rates')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'CityList' => $CityList,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   editRate
    public function editRate($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = ShippingRates::findOrFail($id);

        return view('AppPlugin.Orders.shipping.rates_edit')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
        ]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function updateRates(ShippingRateRequest $request, $id = 0) {
        $saveData = ShippingRates::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $saveData->cat_id = $request->input('cat_id');
                $saveData->price_from = $request->input('price_from');
                $saveData->price_to = $request->input('price_to');
                $saveData->rate = $request->input('rate');
                $saveData->save();

            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        return redirect()->route('admin.ShopOrders.Shipping.ratesIndex', $request->input('cat_id'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroyRates($id) {
        $deleteRow = ShippingRates::where('id', $id)->firstOrFail();
        $deleteRow->delete();
        return back()->with('confirmDelete', "");
    }


}
