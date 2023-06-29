<?php

namespace app\modules\edit\models;

use Yii;
use app\modules\edit\models\ProductsOrder;
/**
 * This is the model class for table "order_product".
 *
 * @property int $id
 * @property int|null $id_product
 * @property string|null $size_product
 * @property string|null $material_product
 * @property string|null $side_product
 * @property string|null $color_product
 * @property int|null $count
 * @property int|null $cost
 * @property int|null $id_order
 *
 * @property Products $product
 */
class Orders extends \yii\db\ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->dbFrontEnd;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_product';
    }

    public function rules()
    {
        return [
            [['id_product', 'count', 'cost', 'id_order', 'status'], 'integer'],
            [['title', 'size_product', 'material_product', 'side_product', 'color_product'], 'string', 'max' => 50],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'title' => 'Title',
            'img' => 'Img',
            'size_product' => 'Size Product',
            'material_product' => 'Material Product',
            'side_product' => 'Side Product',
            'color_product' => 'Color Product',
            'count' => 'Count',
            'cost' => 'Cost',
            'id_order' => 'Id Order',
            'status' => 'Status',
        ];
    }
}
