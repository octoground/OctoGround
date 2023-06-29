<?php

namespace app\modules\install\controllers;

use yii;
use yii\web\Controller;
use app\models\Params;
use app\modules\install\models\Settings;


class ParamsController extends Controller
{
    // public $layout = 'install';

    public function actionIndex() {
        
        
        $filename = Yii::getAlias('@webroot/../application/config/params.php');
  
        // // Запись.
        // $data = serialize($lines);      // PHP формат сохраняемого значения.
        // $lines = json_encode($lines);  // JSON формат сохраняемого значения.
        // file_put_contents($filename, $data);
        
        // // Чтение.
        // $data = file_get_contents($filename);
        // $data = unserialize($data); // Если нет TRUE то получает объект, а не массив.
        // var_dump($data);

        // $array = array(
        //     1 => 'Номер один', // Ключ: число; Значение: строка
        //     'two' => 2, // Ключ: строка; Значение: число
        //     'three' => 'Это номер три', // Ключ: строка; Значение: строка
        //     4 => 4 // Ключ: число; Значение: число
        // );
        // // еще одно значение добавим таким способом
        // $array[] = 'Супер значение';
        
        // запишем массив в файл
        $this->object2file($array, $filename);
        // в файл array.txt будет записана следующая информация:
        // serialize $array
        // a:5:{i:1;s:19:"Номер один";s:3:"two";i:2;s:5:"three";s:24:"Это номер три";i:4;i:4;i:5;s:27:"Супер значение";}
        // var_dump($data );

        if (Settings::find()->where(['is_installed' => 0])->exists()) {
            $this->redirect(['/install/main/index']);
            return false;
        }
        

        $content = file_get_contents($filename);

        $base = explode('\r',$content);
        $base = explode(',',$base[0]);
        // echo '<pre>';
        // print_r($base);
        // echo '</pre>';
  


        $model = new Params();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(Yii::$app->request->referrer);
        }
        foreach ($base as $key => $value) {
            if ($key != '0' || strlen($value) <= 15) {
                $id =  trim(explode('=>', $value)[0]);
                $res =  trim(explode('=>', $value)[1]);

                $id = str_replace("'", '', $id);
                $res = str_replace("'", '', $res);
                

                if($id != ');'){
                    // var_dump($id);
                    $model[$id] = $res;
                }
                
            }
        }
        
        // $model->load($params);
        // var_dump($model);


        return $this->render('index', compact('model'));
    }
    /**
     * void object2file - функция записи объекта в файл
     *
     * @param mixed value - объект, массив и т.д.
     * @param string filename - имя файла куда будет произведена запись данных
     * @return void
     *
     */
    public function array_key_last(array $array) {
        $filename = Yii::getAlias('@webroot/../application/config/params.php');
        $lines = file($filename);
        return count($lines) - 1;
        // 100000 iters: ~0.068 secs
        return key(array_slice($array, -1));
        // 100000 iters: ~0.070 secs
        return key(array_reverse($array));
        // 100000 iters: ~0.088 secs
        return array_keys($array)[count($array) - 1] ?? null;
    }
    public function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
    function object2file($value, $filename)
    {
        $str_value = serialize($value);

        $f = fopen($filename, 'w');
        fwrite($f, $str_value);
        fclose($f);
    }


    /**
     * mixed object_from_file - функция восстановления данных объекта из файла
     *
     * @param string filename - имя файла откуда будет производиться восстановление данных
     * @return mixed
     *
     */
    function object_from_file($filename)
    {
        $file = file_get_contents($filename);
        $value = unserialize($file);
        return $value;
    }
}
