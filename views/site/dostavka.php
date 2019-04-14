<?php

/*
 * service page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid hidden-xs">
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
                                                                <li>Доставка транспортной компанией</li>
                                                        </ul>
                                                </div>
                                                
                                                <div class="page-block">
                                                        <h2>Доставка по Красноярску</h2>
                                                        
                                                        <ul class="checked-list">
                                                                <li>Доставка по Красноярску в течение 5-7 раб/дней со момента оплаты товара</li>
                                                                <li>Стоимость доставки по Красноярску - бесплатно</li>
                                                        </ul>
                                                </div>

                                                <div class="page-block">
                                                        <h2>Доставка по Красноярскому краю и другим регионам РФ</h2>
                                                        <ul class="checked-list">
                                                                <li>Мы работаем с ПЭК, ТрансГарант, Энергия, ЖелДорЭкспедиция, Деловые линии, ГарантПост и другими ТК</li>
                                                                <li>Стоимость доставки - бесплатно при заказе свыше 5 000 р.</li>
                                                                <li>Услуги ТК оплачивает клиент при получении товара</li>
                                                        </ul>
                                                </div>
                                                
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>