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
            // получаем tovar_id из куки
            $tovarId = Yii::$app->getRequest()->getCookies()->getValue('sbt24goods', (isset($_COOKIE['sbt24goods']))? $_COOKIE['sbt24goods']: 'sbt24goods');
            if($tovarId) {
                $orderItem->tovar_id = $tovarId;
                $price = $this->convertCurrenciesToPrice($tovarId);
                $orderItem->sum = $price;
                $orderItem->count = 1;
                $orderItem->save();
            }
            
            
            // добавляем cookie sbt24order, где храним id заказа
            $cookie = new \yii\web\Cookie([
                'name' => 'sbt24order',
                'value' => $this->id,
                'expire' => time() + 60 * 60 * 24 * 365,
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
            //header("Refresh: 0");
        } else {
            // если order уже существует
            // если post пришел не из actionOrder, actionProfile, то:
            if ( Yii::$app->controller->action->id != 'order'
                    && Yii::$app->controller->action->id != 'profile') {  
                $orderItem = new OrderItems();
                // получаем order_id из куки
                $orderItem->order_id = Yii::$app->getRequest()->getCookies()->getValue('sbt24order');
                // получаем tovar_id из куки
                $tovarId = Yii::$app->getRequest()->getCookies()->getValue('sbt24goods', (isset($_COOKIE['sbt24goods']))? $_COOKIE['sbt24goods']: 'sbt24goods');
                $orderItem->tovar_id = $tovarId;
                $price = $this->convertCurrenciesToPrice($tovarId);
                $orderItem->sum = $price;
                $orderItem->count = 1;
                $orderItem->save();
            }
        }

    }

    /*  */
    public function getOrderSum($id)
    {
        $items = OrderItems::find()->where(['order_id' => $id])->all();
        $sum = 0;
        foreach ($items as $key => $item) {
            $sum += ($item->sum * $item->count);
        }
        if(strpos($sum, '.')) {
            if(substr($sum, -3, 1) != '.') {
                $sum = round($sum,2).'0';
            }
        }
        if(!strpos($sum, '.')) {
            $sum = $sum.'.00';
        } else
        $sum = round($sum,2);
        return $sum;
    }

    /*  */
    public function convertCurrenciesToPrice($tovar_id)
    {
        $tovar = Tovar::find()->where(['id' => $tovar_id])->one();
        $currencies = $this->getCurrencies();
        if ($tovar->price_rub != 0) { 
            $price = round($tovar->price_rub,2);
        } 
        elseif ($tovar->price_usd != 0) {
            $price = round(($tovar->price_usd * $currencies['USD']),2);
        } 
        elseif ($tovar->price_eur != 0) {
            $price = round(($tovar->price_eur * $currencies['EUR']),2);
        }
        else {
            return $price = 0;
        }

        if ($tovar->discount != 0) {
            $price = round(($price - $price/100*$tovar->discount),2);
        }

        return round($price,2);
    }

/*
    * get currency daily course - http://know-online.com/post/php-valuta
    */
    protected function getCurrencies() {
        //$xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        if (file_exists('http://cbr.ru/scripts/XML_daily.asp')) {
            $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        } else {
            $xml = simplexml_load_file('../web/plugins/XML_daily.asp');
        }
        
        $currencies = array();
        foreach ($xml->xpath('//Valute') as $valute) {
            $currencies[(string)$valute->CharCode] = (float)str_replace(',', '.', $valute->Value);
        }
        return $currencies;
    }

}
