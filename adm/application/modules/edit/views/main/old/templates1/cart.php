<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use app\modules\edit\models\Checkbox;
    use yii\widgets\ActiveForm;

    $models = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$table} WHERE {$field} = {$id}")->queryAll();

    echo "<div class='row edit_row'>";
        echo "<div class='col-lg-12'>";
            echo "<div class='linked_content edit_view'>";

                foreach ($models as $key => $product) {
                    $tbl = $product['is_accessory'] ? 'accessory' : 'product';
                    $title = $product['is_accessory'] ? 'title' : 'name';
                    $model = \Yii::$app->dbFrontEnd->createCommand("SELECT * FROM {$tbl} WHERE id = {$product["product_id"]}")->queryOne();
                    echo "<div class='edit_view_cart'>";
                        echo Html::img($model['img']);
                        echo 'Наименнование:' . $model[$title] . '<br>';
                        echo 'Стоимость:' . $product['cost'] . '<br>';
                        echo 'Количество:' . $product['count'] . '<br>';
                        echo 'Материал:' . $product['product_material'] . '<br>';
                        echo 'Стенки:' . $product['product_walls'] . '<br>';
                        echo 'Размеры:' . $product['product_size'] . '<br>';
                    echo "</div>";
                }

                /**
                 * конец
                 */
            echo "</div>"; 
        echo "</div>"; 
    echo "</div>";
