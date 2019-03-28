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
                                                    <p class="bg-warning">Информация о клиентах. Клиентом считается тот, кто сделал заказ,. "Гость" - клиент, который добавил товар в корзину, но не сделал заказ </p>
                                                </header>

                                                <div class="goods-container">	
                                                    <div class="dashboard row">

                                                        <div class="col-xs-12 col-sm-8 col-md-10 col-lg-10 text-left">
                                                            <div class="dashboard-block" style="min-height: 70px;">
                                                                <div id="search" class="form-inline">
                                                                    <div class="input-group col-sm-12">
                                                                        <input id="admin-clients-search-input" class="form-control" type="text" placeholder="Найти клиента..." aria-label="Поиск...">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-default" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end-col -->
                                                        <div class="col-xs-12 col-md-6 col-lg-5 text-left hidden">
                                                            <div class="dashboard-block" style="min-height: 70px;">
                                                                <!--<div class="row">
                                                                    <div class="col-xs-7">
                                                                        <select id="select-client-sort" class="form-control">
                                                                            <option value="1" selected>Номер</option>
                                                                            <option value="2">Компания</option>
                                                                            <option value="3">Когда создан</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-xs-5">
                                                                        <div id="btn-client-sort" class="btn-group" data-toggle="buttons">
                                                                            <?= Html::button(
                                                                                '<i class="fa fa-arrow-up"></i>',
                                                                                [
                                                                                    'class' => 'btn btn-default active'
                                                                                ]
                                                                            )?>
                                                                            <?= Html::button(
                                                                                '<i class="fa fa-arrow-down"></i>',
                                                                                [
                                                                                    'class' => 'btn btn-default'
                                                                                ]
                                                                            )?>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                            </div>
                                                        </div> <!-- end-col -->
                                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                                            <div class="dashboard-block" style="min-height: 70px;">                                                            
                                                                <select id="select-pages-count" class="form-control">
                                                                    <option value="5">5</option>
                                                                    <option value="10">10</option>
                                                                    <option value="20" selected>20</option>
                                                                    <option value="50">50</option>
                                                                </select>
                                                            </div> <!-- end-dashboard-block -->
                                                        </div> <!-- end-col -->

                                                        <div class="col-xs-12">
                                                            <div class="dashboard-block">
                                                                <div class="client-head row">
                                                                    <div class="col-xs-1 text-center">
                                                                        <h5><a href="#">№</a><!--<i class="fa fa-arrow-down"></i>--></h5>
                                                                    </div>
                                                                    <div class="col-xs-3 text-center">
                                                                        <h5><a href="#">Компания</a><!--<i class="fa fa-arrow-down hidden"></i>--></h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Контакт</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Телефон</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Email</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5><a href="#">Дата</a><i class="fa fa-arrow-down hidden"></i></h5>
                                                                    </div>
                                                                </div> <!-- end-client-head -->

                                                                <?php $clientsCounter = 1; ?>

                                                                <?php foreach ($clients as $key => $client): ?>
                                                                    <div class="client-block row" client="<?= $client->id ?>" page="1">
                                                                        <div class="client-counter col-xs-1 text-center">
                                                                            <?= $clientsCounter?>
                                                                        </div>
                                                                        <div class="client-name-block col-xs-3 text-left">
                                                                            <?php $companyName = $client->company; ?>
                                                                            <?php if($client->company == ''): ?>
                                                                                <?php $companyName = 'Гость'; ?>
                                                                            <?php endif ?>
                                                                            <?= Html::a($companyName, ['../admin/client-view', 'id' => $client->id]) ?>
                                                                        </div>
                                                                        <div class="col-xs-2 text-center">
                                                                            <?= $client->contact ?>                                     
                                                                        </div>
                                                                        <div class="col-xs-2 text-center">
                                                                            <?= $client->phone ?>
                                                                        </div>
                                                                        <div class="col-xs-2 text-center">
                                                                            <?= $client->email ?>
                                                                        </div>
                                                                        <div class="client-date-block col-xs-2 text-center">
                                                                            <span style="font-size: 0.8em;">
                                                                            <?php 
                                                                                $created = new DateTime($client->created);
                                                                            ?>
                                                                            <?= $created->format('d.m.Y') ?>
                                                                            <br>
                                                                            <?= $created->format('H:i:s') ?>
                                                                            </span>
                                                                        </div>
                                                                        <?php $clientsCounter++; ?>
                                                                    </div> <!-- end-client-block -->
                                                                <?php endforeach ?>
                                                            </div> <!-- end-dashboard-block -->
                                                        </div> <!-- end-col -->

                                                        <div class="col-xs-12">
                                                            <div class="dashboard-block">
                                                                <div class="category-pagination-block">
                                                                    <div class="btn-group" data-toggle="buttons">
                                                                        <!--<?php $pageCounter = 2; ?>
                                                                        <?= Html::a(
                                                                            '1', 
                                                                            ['/admin/clients?page=1'], 
                                                                            [
                                                                                'class' => 'btn btn-default active'
                                                                            ]
                                                                        )?>
                                                                        <?php foreach ($clients as $key => $cat): ?>
                                                                            <?= Html::a(
                                                                                $pageCounter, 
                                                                                ['/admin/clients?page='.$pageCounter], 
                                                                                [
                                                                                    'class' => 'btn btn-default'
                                                                                ]
                                                                            )?>
                                                                            <?php $pageCounter++; ?>
                                                                        <?php endforeach ?>-->
                                                                    </div>
                                                                </div> <!-- end-clients-filter-block -->
                                                            </div> <!-- end-dashboard-block -->
                                                        </div> <!-- end-col -->

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