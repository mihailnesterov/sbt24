<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbt_company".
 *
 * @property int $id id компании
 * @property string $name название компании
 * @property string $company_name юридическое название компании
 * @property string $address адрес компании
 * @property string $phone1 телефон 1
 * @property string $phone2 телефон 2
 * @property string $email email
 * @property string $description описание
 * @property string $map карта
 * @property int $status статус
 * @property string $created дата создания
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone1', 'email'], 'required'],
            [['description', 'map'], 'string'],
            [['status'], 'boolean'],
            [['created'], 'safe'],
            [['name', 'company_name', 'email'], 'string', 'max' => 255],
            [['address'], 'string', 'max' => 500],
            [['phone1', 'phone2'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'company_name' => 'Company Name',
            'address' => 'Address',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'email' => 'Email',
            'description' => 'Description',
            'map' => 'Map',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }
}
