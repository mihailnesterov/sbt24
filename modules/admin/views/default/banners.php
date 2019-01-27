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
                                                        <p class="bg-warning">Баннеры выводятся на страницах сайта - на главной, в каталоге, в боковом меню. В данном разделе вы можете добавляять, редактировать и удалять баннеры</p>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">

                                                                <div class="col-xs-12 col-md-6 text-left">
                                                                        <div class="dashboard-block" style="min-height: 70px;">
                                                                                <?= Html::a('<i class="fa fa-plus"></i> Добавить баннер', Yii::$app->urlManager->createUrl(['/admin/banner-add']), ['class' => 'btn btn-success']) ?>
                                                                        </div>
                                                                </div>

                                                                <div class="col-sm-12">
                                                                        <table class="table table-bordered table-responsive">
                                                                        <tbody>
                                                                        <?php foreach ($banners as $key => $banner): ?>
                                                                                <tr>
                                                                                        <td class="text-center">
                                                                                                <div class="banner-image-block">
                                                                                                        <?= Html::img(
                                                                                                                '@web/images/banners/'.$banner->image, 
                                                                                                                [
                                                                                                                        'alt' => $banner->name, 
                                                                                                                        'class' => 'img-responsive'
                                                                                                                ]
                                                                                                        ) ?>
                                                                                                        <div class="btn-block">
                                                                                                                <div class="row">
                                                                                                                        <div class="col-xs-6 col-md-8 text-left">
                                                                                                                                <?= Html::a($banner->name, ['/admin/banner-view', 'id' => $banner->id]) ?>
                                                                                                                        </div>
                                                                                                                        <div class="col-xs-6 col-md-4 text-right">
                                                                                                                                <?= Html::a('<i class="fa fa-edit"></i>', ['/admin/banner-view', 'id' => $banner->id], ['class' => 'btn btn-success', 'title' => 'Редактировать '.$banner->name]) ?>
                                                                                                                                <?= Html::a('<i class="fa fa-close"></i>', ['/admin/delete-banner', 'id' => $banner->id], [
                                                                                                                                        'class' => 'btn btn-danger',
                                                                                                                                        'title' => 'Удалить "'.$banner->name.'"',
                                                                                                                                        'data' => [
                                                                                                                                                        'confirm' => 'Удалить баннер "'.$banner->name.'"?',
                                                                                                                                                        'method' => 'post',
                                                                                                                                                ],
                                                                                                                                        ]
                                                                                                                                ) ?>
                                                                                                                        </div>
                                                                                                                </div>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </td>
                                                                                </tr>
                                                                        <?php endforeach ?>
                                                                        </tbody>
                                                                        </table>
                                                                </div>	<!-- end col -->

                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>