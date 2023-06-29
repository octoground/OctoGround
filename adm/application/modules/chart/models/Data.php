<?php

namespace app\modules\chart\models;

use Yii;
use yii\db\ActiveRecord;


class Data extends ActiveRecord
{
    public $date;

    public static function tableName()
    {
        return 'field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [];
    }

    public function getSets($dateType = 'year', $date_start = false)
    {
        if ($dateType === 'year') {
            $items = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM chart_product ORDER BY date ASC ")->queryAll();
        } else {
            $items = $this->getChangeWeek();
        }

        /**
         * получаем данные
         */
        $sets = [];
        $count = 0;
        foreach ($items as $item) {
            $name = $item['name'];

            if ($dateType === 'year') {
                $date = Yii::$app->formatter->asDate($item['date'], 'MM');
            }
            if ($dateType === 'week') {
                $date = Yii::$app->formatter->asDate($item['date'], 'd');
            }
            
            // $date = Yii::$app->formatter->asDate($item['date'], 'd');

            if (isset($sets[$name])) {
                if (isset($sets[$name]['data'][$date])) {
                    $sets[$name]['data'][$date] += 1;
                } else {
                    $sets[$name]['data'][$date] = 1;
                }
            } else {
                $color_rand1 = rand(1, 255);
                $color_rand2 = rand(1, 255);
                $color_rand3 = rand(1, 255);

                $sets[$name] = [
                    'data' => [$date => 1],
                    'label' => $name,
                    'backgroundColor' => "rgba({$color_rand1}, {$color_rand2}, {$color_rand3},0.4)",
                    'borderColor' => "rgba({$color_rand1}, {$color_rand2}, {$color_rand3}, 0.8)",
                ];
            }
            $count++;
            // var_dump($count);
        }

        /**
         * меняем ключи массива на цифры начиная с 0 (если в ключе использовать не цифры, то графики не работают)
         */
        $datasets = [];
        $count = 0;
        foreach ($sets as $set) {
            $datasets[$count] = $set;
            $count++;
            
        }
   
        /**
         * добавляем пропущенные дни (если в БД есть запись за 9 и 10 месяц, то остальным месяцам присваиваем 0)
         */

        foreach ($datasets as $key => $set) {
            $start = 1;
            $end = $this->currentDateItem($dateType);
            for ($i = $start; $i <= $end; $i++) 
            {
                $date_i = str_pad($i, 2, 0, STR_PAD_LEFT);
                $i_date = $i - 1;

                if ($dateType === 'week') {
                    $date_start = Yii::$app->formatter->asDate($this->date, 'd');
                    $keys = array_keys($set['data']);
                    $week_key = $keys[$i_date] - $date_start + 1;  //разность между выбранной датой и датой из БД для получения id в массиве 

                    if ($week_key >= 0) {
                        $week_key = str_pad($week_key, 2, 0, STR_PAD_LEFT);
                        $datasets[$key]['data'][$week_key] = $datasets[$key]['data'][$keys[$i_date]];
                        unset($datasets[$key]['data'][$keys[$i_date]]);
                    }
                }

                /**
                 * подготовка "ключь - значение" массива
                 */
                if (!isset($datasets[$key]['data'][$date_i])) {
                    $datasets[$key]['data'][$i_date] = 0;
                } else {
                    $val = $datasets[$key]['data'][$date_i];
                    unset($datasets[$key]['data'][$date_i]);
                    $datasets[$key]['data'][$i_date] = $val;
                }
               
            }
        }
        // echo "<pre>";
        // var_dump($datasets);
        // echo "</pre>";
        return $datasets;
    }

    public function getChangeWeek()
    {
        $date_start = $this->date; 
        $date_end = $this->date + 60 * 60 * 24 * 6;

        $items = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM chart_product WHERE date BETWEEN {$date_start} AND {$date_end} ORDER BY date ASC")->queryAll();
        return $items;
    }
    /**
     * type = day | month | year
     * month, year - переменные необходимыя для подсчета количества дней (по умолчинию стоит текущий месяц и год)
     */
    
    public function labelChart($type = 'year', $day_start = null, $year = null)
    {

        $labels = [];
        
        switch ($type) {
            case 'week':
                $day_end = $day_start + 7;
                for ($i= $day_start; $i < $day_end ; $i++) {
                    $labels[] = $i;
                }
                break;
            case 'year':
                $labels = ["Янв", "Фев", "Мар", "Апр", "Май", "Июн", "Июл", "Авг", "Сент", "Окт", "Ноя", "Дек"];
                break;
        }

        return $labels;
    }

    private function currentDateItem($type = 'year')
    {
        // var_dump($type === 'week');
        if ($type === 'year') {
            return date('n');
        }
        if ($type === 'week') {
            return 7;
        }
        return false;
    }
}
