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
                                                <h1>
                                                        <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin', ['class' => 'go-back-link', 'title' => 'Кабинет']) ?>
                                                        <?= Html::encode($this->title) ?>
                                                </h1>
                                                <p class="bg-warning">Добавление, редактирование, удаление товаров</p>
                                        </header>

                                        <div class="goods-container">	
                                                <div class="dashboard row">
                                                    
                                                    <div class="col-xs-12 col-md-5 col-lg-4 text-left">
                                                        <div class="dashboard-block"  style="min-height: 70px;">
                                                            <?= Html::a('<i class="fa fa-plus"></i> Добавить товар', Yii::$app->urlManager->createUrl(['/admin/goods-add']), ['class' => 'btn btn-success']) ?>
                                                        </div>
                                                    </div> <!-- end-col -->
                                                    <div class="col-xs-12 col-md-7 col-lg-8 text-left">
                                                        <div class="dashboard-block" style="min-height: 70px;">
                                                            <form id="search" class="form-inline">
                                                                <div class="input-group col-sm-12">
                                                                    <input class="form-control" type="text" placeholder="Найти товар..." aria-label="Поиск...">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div> <!-- end-col -->

                                                    <div class="col-xs-12">
                                                        <div class="dashboard-block">
                                                        <p>Категории: </p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <?php $catCounter = 1; ?>
                                                                <?= Html::a('Все', ['/admin/goods'], ['class' => 'btn btn-default active']) ?>
                                                                <?php foreach ($categories as $key => $cat): ?>
                                                                    <?= Html::a($cat->getCategoryName($cat->category_id), ['/admin/goods?cat='.$cat->category_id], ['class' => 'btn btn-default', 'cat' => $cat->category_id]) ?>
                                                                    <?php $catCounter++; ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                            <?= Html::a('<i class="fa fa-plus"></i>Добавить категорию', Yii::$app->urlManager->createUrl(['/admin/add-category']), ['class' => 'btn btn-success']) ?>
                                                        </div>
                                                    </div> <!-- end-col -->
                                                        
                                                    <div class="col-sm-12">
                                                        <?php $tovarCounter = 1; ?>
                                                        <table class="table table-bordered table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">
                                                                        №
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Наименование
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Категория
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Цена, руб.
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Цена, USD
                                                                    </th>
                                                                    <th class="text-center">
                                                                        Цена, EUR
                                                                    </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($tovar as $key => $good): ?>
                                                                <tr>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <?= $tovarCounter ?>
                                                                    </td>
                                                                    <td class="text-left" style="vertical-align: middle;">
                                                                        <?= Html::a($good->name, ['../goods-view', 'id' => $good->id]) ?>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <?= Html::a($good->category->name, ['../category-view', 'id' => $good->category_id]) ?>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <?= $good->price_rub ?>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <?= $good->price_usd ?>
                                                                    </td>
                                                                    <td class="text-center" style="vertical-align: middle;">
                                                                        <?= $good->price_eur ?>
                                                                    </td>
                                                                </tr>
                                                                <?php $tovarCounter++; ?>
                                                            <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>	<!-- end col -->
                                                </div>	<!-- end row -->                                                        
                                        </div>	<!-- end goods-container -->

                                        <div>
                                            <?php       
                                                echo LinkPager::widget([
                                                    'pagination' => $pages,
                                                    'registerLinkTags' => true
                                                ]);
                                            ?>
                                        </div>
                                </div>	<!-- end content-block -->
                            </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>