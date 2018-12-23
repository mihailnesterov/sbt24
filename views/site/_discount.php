<?php

/* 
 * new tovar
 */

use yii\helpers\Html;

$currencies = Yii::$app->controller->getCurrencies();
?>
<div class="content-block">
    <header>
            <h2>Товары со скидками</h2>
    </header>
    <div class="goods-container">	
        <div class="row">

            <?php
            // вывод 3-х последних новинок
            $newTovar = app\models\Tovar::find()->where((['>', 'discount', 0]))->orderby(['created'=>SORT_ASC])->limit(3)->all();
                foreach ($newTovar as $new):
                    if ($new->price_rub != 0) { 
                    $price = round($new->price_rub,2);
                    } 
                    if ($new->price_usd != 0) {
                        $price = round(($new->price_usd * $currencies['USD']),2);
                    } 
                    if ($new->price_eur != 0) {
                        $price = round(($new->price_eur * $currencies['EUR']),2);
                    }
                    if ($new->discount != 0) {
                        $discount = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$new->id).'" class="label discount"><span class="flash animated">'.$new->discount.'%</span></a>';
                        $old_price = round($price,2);
                        $price = round(($price - $price/100*$new->discount),2);
                    } else {
                        $discount = '';
                        $old_price = '';
                    }
                    echo '<div class="col-sm-12 col-lg-4">'
                        . '<div class="goods-block">'
                        . Html::a('<img src="images/tovar2.jpg" alt="'.$new->model.'" class="img-responsive">', [Yii::$app->homeUrl.'../view?id='.$new->id])
                        . '<h4>'.$new->name.'</h4>'
                        . '<p class="goods-price"><span>'.$price.'</span> &#8381;</p>'
                        . Html::button('<i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину', ['class' => 'goods-buy buy-from-preview'])
                        . '</div>    <!-- end goods-block -->'
                        . Html::a('<span><i class="fa fa-eye" aria-hidden="true"></i></span>', [Yii::$app->homeUrl.'../view?id='.$new->id], ['class' => 'label'])    
                        . '</div>    <!-- end col -->';
                endforeach;
            ?>
        </div>	<!-- end row -->
    </div>	<!-- end goods-container -->
</div>	<!-- content-block -->