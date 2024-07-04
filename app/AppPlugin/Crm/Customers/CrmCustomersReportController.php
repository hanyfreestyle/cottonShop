<?php

namespace App\AppPlugin\Crm\Customers;

use App\AppPlugin\Crm\Customers\Models\CrmCustomers;
use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\Data\Country\Country;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\ReportFunTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class CrmCustomersReportController extends AdminMainController {
    use ReportFunTraits ;

    function __construct() {
        parent::__construct();
        $this->controllerName = "CrmCustomer";
        $this->PrefixRole = 'crm_customer';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->defLang = "admin/crm/customers.";
        View::share('defLang', $this->defLang);

        $this->defCountry = "eg";
        View::share('defCountry', $this->defCountry);

        $this->phoneAreaCode = false;
        View::share('phoneAreaCode', $this->phoneAreaCode);

        $CashCountryList = self::CashCountryList();
        View::share('CashCountryList', $CashCountryList);

        $this->Config = [
            'addAddress' => true,
            'evaluation' => true,
        ];

        View::share('Config', $this->Config);


        $this->PageTitle = __($this->defLang . 'app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName.".Report";

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'AddAction' => false,
            'configArr' => ["filterid" => 0],
            'yajraTable' => true,
            'AddLang' => false,
            'restore' => 0,
            'formName' => "CrmCustomersReportFilter",
        ];

        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function report(Request $request) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";


        $session = self::getSessionData($request);
        $rowData = CrmCustomersController::CustomerDataFilterQ(CrmCustomersController::indexQuery(), $session);


        $AllData = CrmCustomers::count();
        $chartData['Evaluation'] = self::ChartDataFromDataConfig($AllData, 'EvaluationCust', 'evaluation_chart');
        $chartData['Country'] = self::ChartDataFromModel($AllData, Country::class, 'country_chart');
        $chartData['City'] = self::ChartDataFromModel($AllData, City::class, 'city_chart');
        $chartData['Area'] = self::ChartDataFromModel($AllData, Area::class, 'area_chart');


        return view('AppPlugin.CrmCustomer.report')->with([
            'pageData' => $pageData,
            'AllData' => $AllData,
            'chartData' => $chartData,
            'rowData' => $rowData,
        ]);

    }





}
