<?php

namespace App\Http\Traits;


use App\AppPlugin\Data\ConfigData\Models\ConfigData;

trait ReportFunTraits {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromModel($AllData, $Model, $relation, $limit = 10) {

        $relationName = $relation;
        $relationCount = $relation . '_count';

        $getSoursData = $Model::query()->where('is_active', true)
            ->withCount($relationName)
            ->with('translation')
            ->orderBy($relationCount, 'desc')
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $relationCount, $limit);
        return $sendArr;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ChartDataFromDataConfig($AllData, $CatId, $relation, $limit = 10) {

        $relationName = $relation;
        $relationCount = $relation . '_count';

        $getSoursData = ConfigData::query()->where('cat_id', $CatId)
            ->withCount($relationName)
            ->with('translation')
            ->orderBy($relationCount, 'desc')
            ->get();

        $sendArr = self::LoopForGetData($AllData, $getSoursData, $relationCount, $limit);
        return $sendArr;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function LoopForGetData($AllData, $getSoursData, $relationCount, $limit) {
        $countAllData = $AllData;
        $sendArr = [];
        $countData = 0;
        $other_count = 0;
        $start = 0;
        foreach ($getSoursData as $SoursData) {
            if ($start < $limit) {
                if ($SoursData->$relationCount > 0) {

                    $persent = round(($SoursData->$relationCount / $countAllData) * 100) . "%";
                    $arr = [
                        'name' => "(" . $SoursData->$relationCount . ") " . $SoursData->name . " " . $persent,
                        'count' => $SoursData->$relationCount
                    ];
                    array_push($sendArr, $arr);
                }
            } else {
                $other_count = $other_count + $SoursData->$relationCount;
            }
            $countData = $countData + $SoursData->$relationCount;
            $start = $start + 1;
        }

        if ($other_count > 0) {
            $persent = round(($other_count / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $other_count . ") " . __('admin/def.report_other') . " " . $persent,
                'count' => $other_count,
                'setColor' => "#FF6600"
            ];
            array_push($sendArr, $arr);
        }

        if ($countData < $AllData) {

            $persent = round((($AllData - $countData) / $countAllData) * 100) . "%";
            $arr = [
                'name' => "(" . $AllData - $countData . ") " . __('admin/def.report_undefined') . " " . $persent,
                'count' => $AllData  - $countData,
                'setColor' => "#FF0000"
            ];
            array_push($sendArr, $arr);
        }

        return $sendArr;
    }

}
