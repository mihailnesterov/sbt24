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
 * @property string $link ссылка категории
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
     * @var UploadedImage
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['name', 'link'], 'required'],
            [['name', 'link', 'title', 'keywords'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['imageFile'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true, 'maxSize' => 2048 * 1024, 'tooBig' => 'Размер файла не должен превышать 2 MB'],
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
            'name' => 'Название категории',
            'link' => 'Ссылка  в адресной строке',
            'title' => 'Заголовок (title)',
            'keywords' => 'Ключевые слова (keywords)',
            'description' => 'Описание (description)',
        ];
    }

    /**
     * @return tovarCount
     */
    public function getTovarCount($id)
    {
        return $tovarCount = Tovar::find()->where(['category_id' => $id])->count();
    }

    /**
     * @return subcategory
     */
    public function getSubcategory($id)
    {
        return $subcategory = Category::find()->where(['parent' => $id])->all();
    }

    /**
     * @return subTovarCount
     */
    public function getSubTovarCount($id)
    {
        $childCat = Category::find()->where(['parent' => $id])->all();
        $subTovarCount = 0;
        
        foreach ($childCat as $cat):
            $subTovarCount += Tovar::find()->where(['category_id' => $cat->id])->count();
        endforeach;
        
        return $subTovarCount;
    }

    /**
     * @return [$price_min, $price_max] !!! not used
     */
    public function getMinMaxTovarPrice($id)
    {
        $tovar = Tovar::find()->where(['category_id' => $id]);
        
        /*$tovar_rub = Tovar::find()->where(['category_id' => $id])->andWhere('!=','price_rub',0)->min('price_rub');
        $tovar_usd = Tovar::find()->where(['category_id' => $id])->andWhere('!=','price_usd',0);
        $tovar_eur = Tovar::find()->where(['category_id' => $id])->andWhere('!=','price_eur',0);*/
        
        // get all prices != 0
        //$min_rub = $min_usd = $min_eur = $max_rub = $max_usd = $max_eur = 0;
        
        /*$min_rub = $tovar ? $tovar->min('price_rub') : 0;
        $min_usd = $tovar ? $tovar->min('price_usd') : 0;
        $min_eur = $tovar ? $tovar->min('price_eur') : 0;
        
        $max_rub = $tovar ? $tovar->max('price_rub') : 0;
        $max_usd = $tovar ? $tovar->max('price_usd') : 0;
        $max_eur = $tovar ? $tovar->max('price_eur') : 0;*/

        $min_rub = $tovar->min('price_rub');
        if($min_rub == 0) echo $min_rub.'<br>';
        else $min_rub = $tovar->andWhere('!=','price_rub',0)->min('price_rub');
        $min_usd = $tovar->min('price_usd');
        $min_eur = $tovar->min('price_eur');
        
        $max_rub = $tovar->max('price_rub');
        $max_usd = $tovar->max('price_usd');
        $max_eur = $tovar->max('price_eur');

        // get curriencies rate
        $currencies = Yii::$app->controller->getCurrencies();

        // find min / max price
        $price_min = round(min($min_rub, $min_usd * $currencies['USD'], $min_eur * $currencies['EUR']),2);
        $price_max = round(max($max_rub, $max_usd * $currencies['USD'], $max_eur * $currencies['EUR']),2);

        /*if ($min_rub != 0) { $price_min = $min_rub; }
            elseif ($min_usd != 0) { $price_min = round($min_usd * $currencies['USD'],2); } 
            elseif ($min_eur != 0) { $price_min = round($min_eur * $currencies['EUR'],2); }
        else { $price_min = 0; }

        if ($max_rub != 0) { $price_max = $max_rub; }
            elseif ($max_usd != 0) { $price_max = round($max_usd * $currencies['USD'],2); } 
            elseif ($max_eur != 0) { $price_max = round($max_eur * $currencies['EUR'],2); }
        else { $price_max = 0; }*/

        /*
        if ($min_rub != 0) { $price_min = round($min_rub,2); }
            elseif ($min_usd != 0) { $price_min = round($min_usd * $currencies['USD'],2); } 
            elseif ($min_eur != 0) { $price_min = round($min_eur * $currencies['EUR'],2); }
        else { $price_min = 0; }

        if ($max_rub != 0 && $max_usd == 0 && $max_eur == 0) { 
            $price_max = round($max_rub,2); 
        }
            elseif ($max_rub == 0 && $max_usd != 0) { $price_max = round($max_usd * $currencies['USD'],2); } 
            elseif ($max_rub == 0 && $max_eur != 0) { $price_max = round($max_eur * $currencies['EUR'],2); }
        else { $price_max = 0; }
        */
        
        

        // add *.00 or *.*x for min / max prices
        if(strpos($price_min, '.')) {
            if(substr($price_min, -3, 1) != '.') {
                $price_min = round($price_min,2).'0';
            }
        }
        if(!strpos($price_min, '.')) {
            $price_min = $price_min.'.00';
        }

        if(strpos($price_max, '.')) {
            if(substr($price_max, -3, 1) != '.') {
                $price_max = round($price_max,2).'0';
            }
        }
        if(!strpos($price_max, '.')) {
            $price_max = $price_max.'.00';
        }

        $result = [
            'price_min' => $price_min,
            'price_max' => $price_max,
            'max_rub' => $max_rub,
            'max_usd' => $max_usd,
            'max_eur' => $max_eur,
            'min_rub' => $min_rub,
            'min_usd' => $min_usd,
            'min_eur' => $min_eur,
        ];
        
        return $result;
    }

    /**
     * @return uploaded image file
     */
    public function upload($imageFile, $image){
        if($this->validate()){            
            $filename = 'images/catalog/'.$image;
            $imageFile->saveAs($filename);
            return false;
        } else {
            return false;
        }
    }

}
