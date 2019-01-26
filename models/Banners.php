<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbt_banners".
 *
 * @property int $id id баннера
 * @property string $name название баннера
 * @property string $image путь к изображению
 * @property int $position № позиции
 * @property string $link ссылка на ресурс
 * @property string $created дата создания
 */
class Banners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image', 'position'], 'required'],
            [['position'], 'integer'],
            [['created'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 50],
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
            'image' => 'Image',
            'position' => 'Position',
            'link' => 'Link',
            'created' => 'Created',
        ];
    }
}
