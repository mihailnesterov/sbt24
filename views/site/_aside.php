<?php

/* 
 * aside
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// получаем структуру каталога
$category = Yii::$app->controller->getCatalog('category');
// получаем курсы валют
$currencies = Yii::$app->controller->getCurrencies();
// получаем товары со скидками
$discounts = Yii::$app->controller->getAsideDiscounts('discounts');

?>
<aside class="col-sm-5 col-md-4">
    <div class="aside-block default">
        <nav id="catalog-menu" class="navbar navbar-default">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="#"><?= Yii::$app->name ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Каталог товаров</h3>
                    <li>
                        <form id="search" class="form-inline">
                            <div class="input-group col-xs-12">
                                <input class="form-control" type="text" placeholder="Поиск по каталогу..." aria-label="Поиск...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </form>
                        <hr>
                    </li>
                    <?php
                        // вывод меню
                        foreach ($category as $cat):
                            $sub_category = \app\models\Category::find()->where(['parent' => $cat->id])->all();
                            if ($sub_category == NULL) {
                                echo '<li><a href="'.Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]).'"><i class="fa fa-arrow-right"></i>'.$cat->name.'</a></li>';
                            } else {
                                echo '<li role="presentation" class="dropdown">'
                                . '<a href="'.Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]).'" data-target="'.Yii::$app->urlManager->createUrl(['catalog/'.$cat->link]).'" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-right"></i>'.$cat->name.'  <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
                                    echo '<ul class="dropdown-menu">';
                                        foreach ($sub_category as $sub_cat):
                                            echo '<li><a href="'.Yii::$app->urlManager->createUrl(['catalog/'.$sub_cat->id]).'">'.$sub_cat->name.'</a></li>';
                                        endforeach;
                                    echo '</ul>';
                                echo '</li>';
                            }

                        endforeach;
                    ?>
                    <div class="visible-xs">
                        <hr>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= Yii::$app->urlManager->createUrl('/') ?>"><i class="fa fa-arrow-right"></i>Главная</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('catalog') ?>"><i class="fa fa-arrow-right"></i>Каталог</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('services') ?>"><i class="fa fa-arrow-right"></i>Услуги</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('dostavka') ?>"><i class="fa fa-arrow-right"></i>Доставка</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('payment') ?>"><i class="fa fa-arrow-right"></i>Оплата</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('about') ?>"><i class="fa fa-arrow-right"></i>О компании</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('contacts') ?>"><i class="fa fa-arrow-right"></i>Контакты</a></li>
                        </ul>
                    </div>
                </ul>   <!-- nav navbar-nav -->
            </div>  <!-- end #navbar -->
        </nav>  <!-- end catalog-menu -->
    </div>  <!-- end aside-block -->

    <div class="aside-block">
            <div class="banner-block">
                    <header>
                            <h3>Товары со скидками</h3>
                            <br>
                    </header>
                    <div class="goods-container">
                        <?php foreach ($discounts as $key => $tovar): ?>
                            <?php
                                if ($tovar->price_rub != 0) { 
                                    $price = round($tovar->price_rub,2);
                                } 
                                if ($tovar->price_usd != 0) {
                                    $price = round(($tovar->price_usd * $currencies['USD']),2);
                                } 
                                if ($tovar->price_eur != 0) {
                                    $price = round(($tovar->price_eur * $currencies['EUR']),2);
                                }
                                if ($tovar->discount != 0) {
                                    $old_price = round($price,2);
                                    $price = round(($price - $price/100*$tovar->discount),2);
                                }
                            ?>
                            <div class="goods-block">
                                    <?= Html::a('<img src="images/tovar2.jpg" alt="'.$tovar->name.'" class="img-responsive">', [Yii::$app->homeUrl.'../view?id='.$tovar->id]) ?>
                                    <h4><?= $tovar->name ?></h4>
                                    <p class="goods-price"><s><?= $old_price ?></s> <span><?= $price ?></span> &#8381;</p>
                                    <?= Html::a('Купить со скидкой '.$tovar->discount.'%', [Yii::$app->homeUrl.'../view?id='.$tovar->id], ['class' => 'goods-buy']) ?>
                                    <!--<button class="goods-buy buy-from-preview"><i class="fa fa-shopping-cart"></i> В корзину</button>-->
                                    <?= Html::a('<span class="flash animated">'.$tovar->discount.'%</span>', [Yii::$app->homeUrl.'../view?id='.$tovar->id], ['class' => 'label']) ?>
                                    <!--<a href="#" class="label">
                                       <span><?= $tovar->discount ?>%</span>
                                    </a>-->
                            </div>                               
                        <?php endforeach ?>

                    </div>	<!-- end col -->
            </div>
    </div><!-- end aside-block -->

    <div class="aside-block">
            <div class="banner-block">
                    <a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
            </div>
    </div><!-- end aside-block -->

    <div class="aside-block">
            <div class="banner-block">
                    <a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
            </div>
    </div><!-- end aside-block -->

</aside><!-- end aside -->