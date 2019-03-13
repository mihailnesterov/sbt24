<?php

/*
 * service page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                        <?php
                                            echo Breadcrumbs::widget([
                                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                            ]);
                                        ?>
                                </div>

                        </div>	 <!-- end row -->
                </div> <!-- end container -->
        </div> <!-- end container-fluid -->

        <div id="page-container" class="container">

                <div class="row">

                        <?php
                            // aside
                            echo $this->render('_aside');
                        ?>

                        <div class="col-sm-7 col-md-8">
                                <div id="content-container">

                                        <div class="content-block">
                                                <header>
                                                    <h1><?= Html::encode($this->title) ?></h1>
                                                </header>
                                            
                                                <?php foreach ($bannersPos7 as $key => $banner): ?>
                                                        <div class="banner-block">
                                                                <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
                                                        </div><!-- end banner-block -->
                                                <?php endforeach ?>

                                                <div class="page-block">
                                                        <h2>Виды доставки</h2>
                                                        
                                                        <ul class="checked-list">
                                                                <li>Самовывоз со склада</li>
                                                                <li>Можно забрать товар в день оформления заказа или когда он поступит на склад.</li>
                                                        </ul>
                                                </div>
                                                
                                                <div class="page-block">
                                                        <h2>Доставка по Красоярску</h2>
                                                        
                                                        <ul class="checked-list">
                                                                <li>Курьерская служба привезет товары в течение 1-3 дней.</li>
                                                                <li>Для товаров под заказ срок отгрузки уточнит менеджер.</li>
                                                        </ul>
                                                </div>

                                                <div class="page-block">
                                                        <h2>Доставка по Красоярскому краю и России</h2>
                                                        <ul class="checked-list">
                                                                <li>Доставим товар на склад транспортной компании, далее перевозкой занимается ТК. </li>
                                                                <li>Работаем с ПЭК, ТрансГарант, Энергия, ЖелДорЭкспедиция, Деловые линии, ГарантПост и др. </li>
                                                                <li>Стоимость доставки до склада 350 р., при заказе свыше 50 000 р. бесплатно. </li>
                                                                <li>Услуги ТК оплачивает клиент при получении товара.</li>
                                                        </ul>
                                                </div>
                                                
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>