<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

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
     * @var UploadedImage
     */
    public $imageFile;
    

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
            [['imageFile'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true, 'maxSize' => 2048 * 1024, 'tooBig' => 'Размер файла не должен превышать 2 MB'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название баннера',
            'image' => 'Картинка баннера',
            'position' => 'Позиция',
            'link' => 'Ссылка на товар',
            'created' => 'Created',
        ];
    }

        
    /**
     * @return uploaded image file
     */
    public function upload($imageFile, $image){
        if($this->validate()){            
            $filename = 'images/banners/'.$image;
            $imageFile->saveAs($filename);
            return false;
        } else {
            return false;
        }
    }
}
