<?php

namespace app\models;

use Yii;

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
            [['client_id', 'number', 'cookies'], 'required'],
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
}
