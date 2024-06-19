<?php

namespace App\View\Components\Temp\Tools;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class SortByList extends Component {

    public $sortLink;


    public function __construct(
        Request $request,
                $sortLink = array(),

    ) {

//        dd($request->url());
//        dd(array_merge($request->all(), ['hany'=>'1']));

        $url = $request->url() . "?";
        $sortLink['featured'] = $url . http_build_query(array_merge($request->all(), ['sort' => '1']));
        $sortLink['best_selling'] = $url . http_build_query(array_merge($request->all(), ['sort' => '2']));
        $sortLink['alphabetically_a_z'] = $url . http_build_query(array_merge($request->all(), ['sort' => '3']));
        $sortLink['alphabetically_z_a'] = $url . http_build_query(array_merge($request->all(), ['sort' => '4']));
        $sortLink['price_low_to_high'] = $url . http_build_query(array_merge($request->all(), ['sort' => '5']));
        $sortLink['price_high_to_low'] = $url . http_build_query(array_merge($request->all(), ['sort' => '6']));
        $sortLink['date_old_to_new'] = $url . http_build_query(array_merge($request->all(), ['sort' => '7']));
        $sortLink['date_new_to_old'] = $url . http_build_query(array_merge($request->all(), ['sort' => '8']));
        for ($i = 1; $i <= 8; $i++) {
            $sortLink['sel_' . $i] = "";
        }

        if($request->sort) {
            for ($i = 1; $i <= 8; $i++) {
                if($request->sort == $i)
                    $sortLink['sel_' . $i] = "selected";
            }
        } else {
            $sortLink['sel_1'] = "selected";
        }

        $this->sortLink = $sortLink;

    }

    public function render(): View|Closure|string {
        return view('components.temp.tools.sort-by-list');
    }
}
