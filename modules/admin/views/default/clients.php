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

                                                        <div class="col-xs-12 col-sm-4 col-md-2">
                                                            <div class="dashboard-block">                                                            
                                                                    <select id="select-pages-count" class="form-control">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
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
                                                                        <h5>№</h5>
                                                                    </div>
                                                                    <div class="col-xs-3 text-center">
                                                                        <h5>Компания</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Контактное лицо</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Телефон</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Email</h5>
                                                                    </div>
                                                                    <div class="col-xs-2 text-center">
                                                                        <h5>Когда создан</h5>
                                                                    </div>
                                                                </div> <!-- end-client-block -->

                                                                <?php $clientsCounter = 1; ?>

                                                                <?php foreach ($clients as $key => $client): ?>
                                                                    <div class="client-block row" client="<?= $client->id ?>" page="1">
                                                                        <div class="client-counter col-xs-1 text-center">
                                                                            <?= $clientsCounter?>
                                                                        </div>
                                                                        <div class="client-name-block col-xs-3 text-left">
                                                                            <?php if($client->company != ''): ?>
                                                                                <?= Html::a($client->company, ['../admin/client-view', 'id' => $client->id]) ?>
                                                                            <?php else: ?>
                                                                                <?= Html::a('Гость', ['../admin/client-view', 'id' => $client->id]) ?>
                                                                            <?php endif ?>
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
                                                                        <div class="col-xs-2 text-center">
                                                                            <?php 
                                                                                $created = new DateTime($client->created);
                                                                            ?>
                                                                            <?= $created->format('d.m.Y') ?>
                                                                            <br>
                                                                            <?= $created->format('H:i:s') ?>
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