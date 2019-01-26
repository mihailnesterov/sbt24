<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid hidden-xs">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                    <br>
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

                                                <div class="goods-container">	
                                                        <div class="dashboard row">
                                                            <div class="col-xs-12 col-md-6 text-center">
                                                                <div class="dashboard-block">
                                                                    <?= Html::a('<i class="fa fa-plus"></i> Добавить товар', Yii::$app->urlManager->createUrl(['/admin/goods-add']), ['class' => 'btn btn-success']) ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-md-6 text-center">
                                                                <div class="dashboard-block">
                                                                    <?= Html::a('<i class="fa fa-plus"></i> Добавить категорию', Yii::$app->urlManager->createUrl(['/admin/goods-add']), ['class' => 'btn btn-success']) ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Товары</h3>
                                                                    <h4><?= Html::a($tovarCount, Yii::$app->urlManager->createUrl(['/admin/goods'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/goods']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Клиенты</h3>
                                                                    <h4><?= Html::a($clientCount, Yii::$app->urlManager->createUrl(['/admin/clients'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/clients']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Заказы</h3>
                                                                    <h4><?= Html::a($orderCount, Yii::$app->urlManager->createUrl(['/admin/orders'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/orders']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Баннеры</h3>
                                                                    <h4><?= Html::a('<i class="fa fa-image"></i>', Yii::$app->urlManager->createUrl(['/admin/banners'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/banners']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Компания</h3>
                                                                    <h4><?= Html::a('<i class="fa fa-building-o"></i>', Yii::$app->urlManager->createUrl(['/admin/company'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/company']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-4 text-center">
                                                                <div class="dashboard-block">
                                                                    <h3>Мой профиль</h3>
                                                                    <h4><?= Html::a('<i class="fa fa-user-o"></i>', Yii::$app->urlManager->createUrl(['/admin/profile'])) ?></h4>
                                                                    <p><?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['/admin/profile']), ['class' => 'btn btn-link btn-lg']) ?></p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>