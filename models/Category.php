<?php

/*
 * categories model
 * 
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "sbt_category".
 *
 * @property int $id id категории
 * @property int $parent id родительской категории
 * @property string $name название категории
 * @property string $title заголовок категории
 * @property string $keywords ключевые слова
 * @property string $description описание категории
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['name'], 'required'],
            [['name', 'title', 'keywords'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id категории',
            'parent' => 'id родительской категории',
            'name' => 'Название',
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
        ];
    }
}
