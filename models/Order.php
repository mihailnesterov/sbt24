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
     * add new order item after insert or update order
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if ($insert) {
            // если новый order
            $orderItem = new OrderItems();
            $orderItem->order_id = $this->id;
            
            $url=$_SERVER['REQUEST_URI'];
            $tovarId = explode('=', $url); 
            $orderItem->tovar_id = $tovarId[1];
            /*$tovar = Tovar::find()->where(['id' => $tovarId[1]])->one();
            $currencies = Yii::$app->controller->getCurrencies();
            if ($tovar->price_rub != 0) { 
                $price = round($tovar->price_rub,2);
            } 
            if ($tovar->price_usd != 0) {
                $price = round(($tovar->price_usd * $currencies['USD']),2);
            } 
            if ($tovar->price_eur != 0) {
                $price = round(($tovar->price_eur * $currencies['EUR']),2);
            }
            if ($tovar->discount != 0) {
                $price = round(($price - $price/100*$tovar->discount),2);
            }
            $orderItem->sum = $price;*/
            $orderItem->count = 1;
            $orderItem->save();           
            // добавляем cookie sbt24order, где храним id заказа
            $cookie = new \yii\web\Cookie([
                'name' => 'sbt24order',
                'value' => $this->id,
                'expire' => time() + 60 * 60 * 24 * 365,
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
            header("Refresh: 0");
        } else {
            // если order уже существует
            // если запрос пришел не из action = order, то:
            if ( Yii::$app->controller->action->id != 'order'
                    && Yii::$app->controller->action->id != 'profile') {  
                $orderItem = new OrderItems();
                // получаем order_id из куки
                $orderItem->order_id = Yii::$app->getRequest()->getCookies()->getValue('sbt24order');
                // получаем tovar_id из URL
                $url=$_SERVER['REQUEST_URI'];
                $tovarId = explode('=', $url); 
                $orderItem->tovar_id = $tovarId[1];
                $orderItem->count = 1;
                $orderItem->save();
            }
        }

    }

    /*  */
    public function getOrderSum($id)
    {
        return $sum = OrderItems::find()->where(['order_id' => $id])->sum('sum');
    }
}
