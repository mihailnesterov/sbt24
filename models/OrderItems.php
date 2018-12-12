<?php

namespace app\models;

use Yii;
use app\models\Tovar;
use app\models\Order;

/**
 * This is the model class for table "sbt_order_items".
 *
 * @property int $id id пункта заказа
 * @property int $order_id id заказа
 * @property int $tovar_id id товара
 * @property string $sum сумма
 * @property int $count количество
 *
 * @property SbtTovar $tovar
 * @property SbtOrder $order
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'tovar_id'], 'required'],
            [['order_id', 'tovar_id', 'count'], 'integer'],
            [['sum'], 'string', 'max' => 20],
            [['tovar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['tovar_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'tovar_id' => 'Tovar ID',
            'sum' => 'Sum',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTovar()
    {
        return $this->hasOne(Tovar::className(), ['id' => 'tovar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
