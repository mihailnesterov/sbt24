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
                                                    <p class="bg-warning">Информация о клиентах. Клиент считается тот, кто сделал заказ,. "Гость" - клиент, который добавил товар в корзину, но не сделал заказ </p>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <?php $clientsCounter = 1; ?>
                                                                <table class="table table-bordered table-responsive table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">
                                                                                №
                                                                            </th>
                                                                            <th class="text-center">
                                                                                Компания
                                                                            </th>
                                                                            <th class="text-center">
                                                                                Контактное лицо
                                                                            </th>
                                                                            <th class="text-center">
                                                                                Телефон
                                                                            </th>
                                                                            <th class="text-center">
                                                                                Email
                                                                            </th>
                                                                            <th class="text-center">
                                                                                Когда создан
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php foreach ($clients as $key => $client): ?>
                                                                        <tr>
                                                                            <td class="text-center" style="vertical-align: middle;">
                                                                                <?= $clientsCounter ?>
                                                                            </td>
                                                                            <td class="text-left" style="vertical-align: middle;">
                                                                                <?php if($client->company != ''): ?>
                                                                                    <?= Html::a($client->company, ['../client-view', 'id' => $client->id]) ?>
                                                                                <?php else: ?>
                                                                                    <?= Html::a('Гость', ['../client-view', 'id' => $client->id]) ?>
                                                                                <?php endif ?>
                                                                            </td>
                                                                            <td class="text-center" style="vertical-align: middle;">
                                                                                <?= $client->contact ?>
                                                                            </td>
                                                                            <td class="text-center" style="vertical-align: middle;">
                                                                                <?= $client->phone ?>
                                                                            </td>
                                                                            <td class="text-center" style="vertical-align: middle;">
                                                                                <?= $client->email ?>
                                                                            </td>
                                                                            <td class="text-center" style="vertical-align: middle;">
                                                                                <?php 
                                                                                    $created = new DateTime($client->created);
                                                                                ?>
                                                                                <?= $created->format('d.m.Y') ?>
                                                                                <br>
                                                                                <?= $created->format('H:i:s') ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php $clientsCounter++; ?>
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