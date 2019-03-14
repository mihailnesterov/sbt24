<?php

/* 
 * aside
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

// получаем структуру каталога
$category = Yii::$app->controller->getCatalog('category');
// получаем курсы валют
$currencies = Yii::$app->controller->getCurrencies();
// получаем товары со скидками
$discounts = Yii::$app->controller->getAsideDiscounts('discounts');
// получаем баннеры
$bannersPos4 = Yii::$app->controller->getAsideBanners('bannersPos4');

mb_internal_encoding('UTF-8');

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
                        <form id="search" method="GET" action="<?= Yii::$app->urlManager->createUrl(['search']) ?>" class="form-inline">
                            <div class="input-group col-xs-12">
                                <input id="q" name="q" class="form-control" type="text" placeholder="Поиск по каталогу..." aria-label="Поиск...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <hr>
                    </li>
                    <?php // вывод меню ?>
                    <?php foreach ($category as $key => $cat): ?>
                        <?php 
                            $sub_category = $cat->getSubcategory($cat->id);
                        ?>
                        <?php if ( $sub_category == NULL): ?>
                            <?php
                                $tovar_count = $cat->getTovarCount($cat->id);
                            ?>
                                <?php if ( $tovar_count != 0): ?>
                                    <li>
                                        <!--<a href="<?= Url::to(['catalog/'.$cat->link]) ?>"><i class="fa fa-arrow-right"></i><?= $cat->name ?></a>-->
                                        <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]) ?>"><i class="fa fa-arrow-right"></i><?= $cat->name ?></a>
                                    </li>
                                <?php endif ?>
                        <?php else : ?>
                            <li role="presentation" class="dropdown">
                                <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]) ?>" data-target="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]) ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-right"></i><?= $cat->name ?>  <i class="fa fa-caret-right"></i></a>
                                <ul class="dropdown-menu row">
                                    <?php foreach ($sub_category as $key => $sub_cat): ?>
                                        <?php $tovar_count = $sub_cat->getTovarCount($sub_cat->id); ?>
                                        <?php if ( $tovar_count != 0): ?>
                                            <li class="category-menu-item text-center col-xs-12 col-md-6">
                                                <img src="images/catalog/<?= $sub_cat->image ?>" alt="<?= $sub_cat->name ?>">
                                                <!--<a href="<?= Url::to(['catalog/'.$cat->link.'/'.$sub_cat->link]) ?>"><?= $sub_cat->name ?> (<?= $tovar_count ?>)</a>-->
                                                <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$sub_cat->id]) ?>"><?= $sub_cat->name ?> (<?= $tovar_count ?>)</a>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>    
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                    
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
                                /*if($old_price != '') {
                                    if(substr($old_price, -3, 1) != '.') {
                                        $old_price = $old_price.'0';
                                    }
                                }

                                if(substr($price, -3, 1) != '.') {
                                    $price = $price.'0';
                                }*/

                                if(strpos($price, '.')) {
                                    if(substr($price, -3, 1) != '.') {
                                        $price = round($price,2).'0';
                                    }
                                }
                                if(strpos($old_price, '.')) {
                                    if(substr($old_price, -3, 1) != '.') {
                                        $old_price = round($old_price,2).'0';
                                    }
                                }
                                if(!strpos($price, '.')) {
                                    $price = $price.'.00';
                                }
                                if(!strpos($old_price, '.') && $old_price != '') {
                                    $old_price = $old_price.'.00';
                                }
                            ?>
                            <div class="goods-block">
                                    <?= Html::a('<img src="images/goods/'.$tovar->photo1.'" alt="'.$tovar->name.'" class="img-responsive img-goods-discount">', [Yii::$app->homeUrl.'../view?id='.$tovar->id]) ?>
                                    <h4><?= $tovar->name ?></h4>
                                    <p class="goods-price"><s><?= $old_price ?></s> <span><?= $price ?></span> &#8381;</p>
                                    <?= Html::a('Купить со скидкой '.$tovar->discount.'%', [Yii::$app->homeUrl.'../view?id='.$tovar->id], ['class' => 'goods-buy']) ?>
                                    <?= Html::a('<span class="flash animated">'.$tovar->discount.'%</span>', [Yii::$app->homeUrl.'../view?id='.$tovar->id], ['class' => 'label']) ?>
                            </div>                               
                        <?php endforeach ?>

                    </div>	<!-- end col -->
            </div>
    </div><!-- end aside-block -->
    
    <?php foreach ($bannersPos4 as $key => $banner): ?>
        <div class="aside-block">
            <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
        </div><!-- end aside-block -->
    <?php endforeach ?>

</aside><!-- end aside -->