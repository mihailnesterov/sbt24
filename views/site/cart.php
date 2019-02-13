<?php

/* 
 * cart page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid">
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
                                            
                                            <table id="cart-table" class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th width="12%"></th>
                                                        <th>Наименование</th>
                                                        <th width="25%" class="text-center">Кол-во</th>
                                                        <th width="15%" class="text-center">Цена, руб.</th>
                                                        <th width="15%" class="text-center">Сумма, руб.</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $itemCount = 0;
                                                        $totalSum = 0;
                                                        foreach ($order['orderItems'] as $item):
                                                            $tovar = app\models\Tovar::find()->where(['id' => $item->tovar_id])->one();
                                                            if ($tovar->price_rub != 0) { 
                                                                $price = round($tovar->price_rub,2);
                                                            } 
                                                            if ($tovar->price_usd != 0) {
                                                                $price = round(($tovar->price_usd * $currencies['USD']),2);
                                                            } 
                                                            if ($tovar->price_eur != 0) {
                                                                $price = round(($tovar->price_eur * $currencies['EUR']),2);
                                                            }
                                                            if ($tovar->discount != 0) {
                                                                $price = round(($price - $price/100*$tovar->discount),2);
                                                            }
                                                            $sum = ($price * $item->count);
                                                            echo '<tr>'
                                                            .'<td class="hidden">'
                                                            .$item->id        
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .Html::a('<img src="images/goods/'.$tovar->photo1.'" alt="" class="img-responsive">', [\Yii::$app->urlManager->createUrl('../view?id='.$tovar->id)])
                                                            .'</td>'
                                                            .'<td>'
                                                            .Html::a($tovar->name, [\Yii::$app->urlManager->createUrl('../view?id='.$tovar->id)], ['class' => 'name-cart-item'])
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .Html::a('<i class="fa fa-minus" aria-hidden="true" title="Удалить"></i>', ['minus-cart-item', 'id' => $item->id], ['class' => 'minus-cart-item', 'data' => ['method' => 'post']])
                                                            .'<span class="cart-item-count">'
                                                            .$item->count
                                                            .'</span>'
                                                            .Html::a('<i class="fa fa-plus" aria-hidden="true" title="Добавить"></i>', ['plus-cart-item', 'id' => $item->id], ['class' => 'plus-cart-item', 'data' => ['method' => 'post']])
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .$price
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .$sum
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .Html::a('<i class="fa fa-times" aria-hidden="true" title="Удалить"></i>', ['delete-cart-item', 'id' => $item->id], ['class' => '', 'data' => ['method' => 'post']])
                                                            .'</td>'
                                                            . '</tr>';
                                                            $itemCount += $item->count;
                                                            $totalSum += $sum;
                                                        endforeach;
                                                    ?>
                                                    <tr>
                                                        <td class="text-center hidden-sm"></td>
                                                        <td>Итого:</td>
                                                        <td class="text-center"><?= $itemCount ?></td>
                                                        <td></td>
                                                        <td class="text-center"><h4><?= $totalSum ?></h4></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div id="cart-table-buttons-block" class="row">
                                                <div class="text-left col-xs-6">
                                                    <?php if( $itemCount != 0 ) { ?>
                                                        <?= Html::a('<i class="fa fa-chevron-left"></i> Назад', 'javascript:history.go(-1)', ['class' => 'btn btn-link text-right', 'title' => 'Вернуться на предыдущую страницу']) ?>
                                                    <?php } else { ?>
                                                        <?= Html::a('<i class="fa fa-chevron-left"></i> В каталог товаров', Yii::$app->urlManager->createUrl('catalog'), ['class' => 'btn btn-link text-right', 'title' => 'Перейти в каталог товаров']) ?>
                                                    <?php } ?>
                                                </div>
                                                <?php if( $itemCount != 0 ) { ?>
                                                <div class="text-right col-xs-6">
                                                     <?= Html::a('Оформить заказ', [Yii::$app->urlManager->createUrl('../order')], ['class' => 'btn btn-success']) ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                                
                                        </div>	<!-- end content-block -->
                                        
                                        <?php
                                            // new tovar
                                            //echo $this->render('_new');
                                        ?>
                                        
                                        <?php
                                            // discont
                                            //echo $this->render('_discount');
                                        ?>

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>