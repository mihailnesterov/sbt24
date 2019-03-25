<?php

/* 
 * order view
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
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
                            echo $this->render('_aside-cart');
                        ?>

                        <div class="col-sm-7 col-md-8">
                                <div id="content-container">

                                        <div class="content-block">
                                                <header>
                                                    <h1><?= Html::encode($this->title) ?></h1>
                                                </header>
                                            <?php $ordersCounter = 1; ?>
                                            <table class="table table-bordered table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            №
                                                        </th>
                                                        <th class="text-center">
                                                            Номер заказа (счета)
                                                        </th>
                                                        <th class="text-center">
                                                            Дата заказа
                                                        </th>
                                                        <th class="text-center">
                                                            Сумма заказа, руб.
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($myorders as $key => $order): ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?= $ordersCounter ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?= Html::a('sbt24-'.$order->id, ['invoice', 'id' => $order->id], ['title' => 'Открыть счет на оплату']) ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php $created = new DateTime($order->created); ?>
                                                            <?= $created->format('d.m.Y') ?> г.
                                                        </td>
                                                        <td class="text-center">
                                                            <?= $order->getOrderSum($order->id) ?>
                                                        </td>
                                                    </tr>
                                                    <?php $ordersCounter++; ?>
                                                <?php endforeach ?>
                                                </tbody>
                                            </table>

                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>