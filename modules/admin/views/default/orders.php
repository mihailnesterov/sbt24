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
                                                <div class="col-sm-12">
                                                    <?php $ordersCounter = 1; ?>
                                                    <table class="table table-bordered table-responsive">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">
                                                                    №
                                                                </th>
                                                                <th class="text-center">
                                                                    № счета
                                                                </th>
                                                                <th class="text-center">
                                                                    Клиент
                                                                </th>
                                                                <th class="text-center">
                                                                    Статус заказа
                                                                </th>
                                                                <th class="text-center">
                                                                    Сумма, руб.
                                                                </th>
                                                                <th class="text-center">
                                                                    Когда создан
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($orders as $key => $order): ?>
                                                            <tr>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    <?= $ordersCounter ?>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    <?= Html::a('sbt24-'.$order->id, ['../order-view', 'id' => $order->id]) ?>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    <?php if($order->client->company != ''): ?>
                                                                        <?= Html::a($order->client->company, ['../client-view', 'id' => $order->client->id]) ?>
                                                                    <?php else: ?>
                                                                        <?= Html::a('Гость', ['../order-view', 'id' => $order->id]) ?>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    <?php if($order->status === 0): ?>
                                                                        В корзине
                                                                    <?php else: ?>
                                                                        Выставлен счет
                                                                    <?php endif ?>
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    0.00
                                                                </td>
                                                                <td class="text-center" style="vertical-align: middle;">
                                                                    <?php 
                                                                        $created = new DateTime($order->created);
                                                                    ?>
                                                                    <?= $created->format('d.m.Y') ?>
                                                                    <br>
                                                                    <?= $created->format('H:i:s') ?>
                                                                </td>
                                                            </tr>
                                                            <?php $ordersCounter++; ?>
                                                        <?php endforeach ?>
                                                        </tbody>
                                                    </table>
                                                </div>	<!-- end col -->
                                            </div>  <!-- end row -->
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