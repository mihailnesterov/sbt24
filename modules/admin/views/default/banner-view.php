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
                                    <?php
                                        echo Breadcrumbs::widget([
                                            'homeLink' => [
                                                'label' => 'Кабинет',
                                                'url' => Yii::$app->urlManager->createUrl('/admin'),
                                            ],
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

                                                <div class="goods-container">	
                                                        <div class="row">

                                                                <div class="col-sm-4">
                                                                        <?= Html::img(
                                                                                '@web/images/banners/'.$model->image, 
                                                                                [
                                                                                        'alt' => $model->name, 
                                                                                        'class' => 'img-responsive'
                                                                                ]
                                                                        ) ?>
                                                                        <div class="btn-block">
                                                                                <div class="row">
                                                                                        <div class="col-xs-6 col-sm-8 text-left">
                                                                                                <?= Html::a($model->name, ['/admin/banner-view', 'id' => $model->id]) ?>
                                                                                        </div>
                                                                                        <div class="col-xs-6 col-sm-4 text-right">
                                                                                                <?= Html::a('<i class="fa fa-edit"></i>', ['/admin/banner-view', 'id' => $model->id], ['class' => 'btn btn-success', 'title' => 'Редактировать '.$model->name]) ?>
                                                                                                <?= Html::a('<i class="fa fa-close"></i>', ['/admin/banner-view', 'id' => $model->id], ['class' => 'btn btn-danger', 'title' => 'Удалить '.$model->name]) ?>
                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                </div>	<!-- end col -->

                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>