<?php

namespace app\models;

use Yii;
use app\models\Clients;
use app\models\OrderItems;
use app\models\Tovar;

/**
 * This is the model class for table "sbt_order".
 *
 * @property int $id id заказа
 * @property int $client_id id клиента
 * @property int $cookies номер из cookies
 * @property string $number номер заказа
 * @property int $status статус заказа
 * @property string $created дата создания
 *
 * @property SbtClients $client
 * @property SbtOrderItems[] $sbtOrderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'required'],
            [['client_id', 'status'], 'integer'],
            [['created'], 'safe'],
            [['number'], 'string', 'max' => 50],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'cookies' => 'Cookies',
            'number' => 'Number',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }
    
    /*
     * add new order item if new order added
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if ($insert) {
            // if new order
            $orderItem = new OrderItems();
            $orderItem->order_id = $this->id;
            
            $url=$_SERVER['REQUEST_URI'];
            $tovarId = explode('=', $url); 
            $orderItem->tovar_id = $tovarId[1];
            //$orderItem->sum = $this->price;
            $orderItem->count = 1;
            $orderItem->save();
        } else {
            // if updates order
        }

    }
}
