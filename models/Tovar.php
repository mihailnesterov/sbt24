<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sbt_tovar".
 *
 * @property int $id id товара
 * @property int $category_id id категории
 * @property string $name название товара
 * @property string $keywords ключевые слова
 * @property string $description мета-описание
 * @property string $text описание товара
 * @property string $price_rub цена, руб
 * @property string $price_usd уена, usd
 * @property string $price_eur цена, euro
 * @property string $discount скидка %
 * @property string $hit хит продаж
 * @property string $brand бренд
 * @property string $type тип
 * @property string $model модель
 * @property int $garantee гарантия (мес)
 * @property string $properties харакеристики товара
 * @property string $abilities возможности товара
 * @property string $advantages преимущества товара
 * @property string $photo1 фото 1
 * @property string $photo2 фото 2
 * @property string $photo3 фото 3
 * @property string $photo4 фото 4
 * @property string $video видео
 * @property string $file1 файл 1
 * @property string $file2 файл 2
 * @property string $file3 файл 3
 * @property string $created дата создания
 *
 * @property SbtCategory $category
 */
class Tovar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sbt_tovar';
    }

    /**
     * @var UploadedImage1
     * @var UploadedImage2
     * @var UploadedImage3
     * @var UploadedImage4
     */
    public $photoFile1;
    public $photoFile2;
    public $photoFile3;
    public $photoFile4;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name','text','photo1'], 'required'],
            [['category_id', 'discount', 'garantee'], 'integer'],
            [['text', 'video', 'properties', 'abililies', 'advantages'], 'string'],
            [['hit'], 'boolean'],
            [['created'], 'safe'],
            [['name', 'keywords', 'description', 'brand', 'type', 'model', 'photo1', 'photo2', 'photo3', 'photo4', 'video', 'file1', 'file2', 'file3'], 'string', 'max' => 255],
            [['price_rub', 'price_usd', 'price_eur'], 'string', 'max' => 20],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['photoFile1','photoFile2','photoFile3','photoFile4'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true, 'maxSize' => 2048 * 1024, 'tooBig' => 'Размер файла не должен превышать 2 MB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id товара',
            'category_id' => 'Категория',
            'name' => 'Название товара',
            'keywords' => 'Ключевые слова (keywords)',
            'description' => 'Описание (description)',
            'text' => 'Описание товара',
            'price_rub' => 'Цена, РУБ',
            'price_usd' => 'Цена, USD',
            'price_eur' => 'Цена, EUR',
            'discount' => 'Скидка %',
            'hit' => 'Хит продаж',
            'brand' => 'Бренд',
            'type' => 'Тип',
            'model' => 'Модель',
            'garantee' => 'Гарантия (мес)',
            'properties' => 'Характеристики',
            'abilities' => 'Возможности',
            'advantages' => 'Преимущества',
            'photo1' => 'Фото 1',
            'photo2' => 'Фото 2',
            'photo3' => 'Фото 3',
            'photo4' => 'Фото 4',
            'video' => 'Видео товара',
            'file1' => 'Файл 1',
            'file2' => 'Файл 2',
            'file3' => 'Файл 3',
            'created' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryName($id)
    {
        $cat = Category::find()->where(['id' => $id])->one();
        return $cat->name;
    }

    /**
     * @return uploaded image file
     */
    public function upload($imageFile, $image){
        if($this->validate()){            
            $filename = 'images/goods/'.$image;
            $imageFile->saveAs($filename);
            return false;
        } else {
            return false;
        }
    }
}
