<?php

namespace app\modules\chart\models;

use Yii;
use yii\base\Model;
use app\modules\chart\models\Data;

class Chart extends Model
{
    /**
     * $type - тип графика (линейный, круговая диаграма и т.д)
     */
    public function getDataLine()
    {
        $model = new Data();
        $data = [
            'labels' => $model->labelChart('year'),
            'datasets' => $model->sets
        ];

        return $data;
    }

    public function getDataDauchhnut()
    {
        $data = [
            // 'labels' => $this->labelChart('month'),
            'labels' => ['Прямая витрина Р11 100х60х40 Черный Сетка 20х20', 'two', 'tree'],
            'datasets' => [
                [
                    'data' => [10, 123, 45],
                    'label' =>  "Линейный график (tºC Урал).",
                    'backgroundColor' => ["rgba(111,11,111,0.4)", "rgba(11,11,111,0.4)", "rgba(111,11,11,0.4)"],
                    // 'borderColor' => "rgba(111, 11, 111,1)",
                ],
            ],


        ];
        return $data;
    }
    
}
