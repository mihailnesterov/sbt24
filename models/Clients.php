<?php

namespace app\models;

use Yii;
use app\models\Order;
use app\models\OrderItems;

/**
 * This is the model class for table "sbt_clients".
 *
 * @property int $id id клиента
 * @property string $company название компании
 * @property string $contact контактное лицо
 * @property string $phone телефон
 * @property string $email email
 * @property string $inn ИНН
 * @property string $kpp КПП
 * @property string $address юр. адрес
 * @property string $bik БИК
 * @property string $account счет
 * @property string $korr_account корр. счет
 * @property string $created дата создания
 *
 * @property SbtOrder[] $sbtOrders
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['company', 'contact', 'phone', 'email'], 'required'],
            [['created'], 'safe'],
            [['company', 'address'], 'string', 'max' => 500],
            [['contact', 'phone', 'email'], 'string', 'max' => 255],
            [['inn', 'kpp', 'bik', 'account', 'korr_account'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'Company',
            'contact' => 'Contact',
            'phone' => 'Phone',
            'email' => 'Email',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'address' => 'Address',
            'bik' => 'Bik',
            'account' => 'Account',
            'korr_account' => 'Korr Account',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['client_id' => 'id']);
    }
    
    /*
     * add new order if new client added
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        if ($insert) {
            // if new client
            if( !Yii::$app->request->cookies->has('sbt24client')) {
                // создаем куку с id клиента
                $cookie = new \yii\web\Cookie([
                    'name' => 'sbt24client',
                    'value' => $this->id,
                    'expire' => time() + 60 * 60 * 24 * 365,
                ]);
                Yii::$app->getResponse()->getCookies()->add($cookie);
                // создаем новый заказ для нового клиента
                $order = new Order();
                $order->client_id = $this->id;
                $order->save();
            }
        } else {
            // if updates client
            $order = Order::find()->where(['client_id' => $this->id])->one();
            $order->save();
        }
    }
}
