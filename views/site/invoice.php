<?php

/* 
 * invoice view
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii2assets\printthis\PrintThis;
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
                            //echo $this->render('_aside-cart');
                        ?>

                        <div class="col-md-10">
                                <div id="content-container">

                                    <div class="content-block">
                                        <header style="background-color: #e0e0e0; padding: 1em;">
                                            <?php
                                                echo PrintThis::widget([
                                                        'htmlOptions' => [
                                                                'id' => 'print-area',
                                                                'btnClass' => 'btn btn-default',
                                                                'btnId' => 'btnPrintThis',
                                                                'btnText' => 'Печать',
                                                                'btnIcon' => 'fa fa-print'
                                                        ],
                                                        'options' => [
                                                                'debug' => false,
                                                                'importCSS' => true,
                                                                'importStyle' => false,
                                                                //'loadCSS' => "path/to/my.css",
                                                                'pageTitle' => 'invoice-sbt24-N'.$order->id,
                                                                'removeInline' => false,
                                                                'printDelay' => 333,
                                                                'header' => null,
                                                                'formValues' => true,
                                                        ]
                                                ]);
                                            ?>
                                            <?= Html::a('<i class="fa fa-file-pdf-o"></i> PDF', [Yii::$app->urlManager->createUrl('../invoice-pdf?id='.$order->id)], [
                                                'class'=>'btn btn-default', 
                                                'target'=>'_blank',
                                                'title'=>'Открыть счет в PDF'
                                            ]); ?>                                            
                                        </header>
                                        
                                        <div id="print-area">
                                            
                                            <table class="table table-responsive table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td><?= $company->bank ?></td>
                                                        <td>БИК</td>
                                                        <td><?= $company->bik ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><small>Банк получателя</small></td>
                                                        <td>Сч. №</td>
                                                        <td><?= $company->account ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <header>
                                                <h2><?= Html::encode($this->title) ?></h2>
                                            </header>

                                            <table class="table table-responsive table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td>Поставщик <br>(Исполнитель)</td>
                                                        <td><?= $company->company_name ?>, 
                                                            ИНН <?= $company->inn ?>,
                                                            КПП <?= $company->kpp ?>,
                                                            <?= $company->address ?>,
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Покупатель <br>(Заказчик)</td>
                                                        <td>
                                                            <?= $client->company ?>
                                                            <?php 
                                                                if($client->inn == '')
                                                                {echo ' ';}
                                                                else
                                                                {echo ', ИНН '.$client->inn;}
                                                            ?>
                                                            <?php 
                                                                if($client->kpp == '')
                                                                    echo ' ';
                                                                else
                                                                    echo ', КПП '.$client->kpp.', ';
                                                            ?>
                                                            <?= $client->address ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table id="cart-table" class="table table-responsive table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="7%" class="text-center">№</td>
                                                        <td class="text-center">Товары (работы, услуги)</td>
                                                        <td width="10%" class="text-center">Кол-во</td>
                                                        <td width="7%" class="text-center">Ед.</td>
                                                        <td width="15%" class="text-center">Цена</td>
                                                        <td width="15%" class="text-center">Сумма</td>
                                                    </tr>
                                                    <?php 
                                                        $itemCount = 0;
                                                        $totalSum = 0;
                                                        $rowCount=1;
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
                                                            .'<td  class="text-center">'
                                                            .$rowCount
                                                            .'</td>'
                                                            .'<td class="text-left">'
                                                            .$tovar->name
                                                            .'</td>'
                                                            .'<td class="text-right">'
                                                            .$item->count
                                                            .'</td>'
                                                            .'<td class="text-left">'
                                                            .'шт'
                                                            .'</td>'
                                                            .'<td class="text-right">'
                                                            .$price
                                                            .'</td>'
                                                            .'<td class="text-right">'
                                                            .$sum
                                                            .'</td>'
                                                            . '</tr>';
                                                            $itemCount += $item->count;
                                                            $totalSum += $sum;
                                                            $rowCount++;
                                                        endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="text-right">
                                                <h5>Итого: <?= round($totalSum,2) ?></h5>
                                                <h5>В том числе НДС: <?= round(($totalSum / 100 * 15),2) ?></h5>
                                                <h5>Всего к оплате: <?= round($totalSum,2) ?></h5>
                                            </div>

                                            <div class="text-left">
                                                <p>Всего наименований <?= $itemCount ?> на сумму <?= round($totalSum,2) ?> руб.</p>
                                                <h4>
                                                    <?= ucfirst(Yii::$app->controller->num2str($totalSum)) ?>
                                                </h4>
                                            </div>

                                            <br>

                                            <div class="text-left">
                                                <p>Внимание!</p>
                                                <p>Оплата данного счета означает согласие с условиями поставки товара.</p>
                                                <p>Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе.</p>
                                                <p>Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</p>
                                            </div>

                                            <br>

                                            <table class="table table-responsive table-bordered" style="margin-bottom: 8em;">
                                                <tbody>
                                                    <tr>
                                                        <td width="18%">Руководитель:</td>
                                                        <td class="text-right">Янов С.А.</td>
                                                        <td class="text-right" width="15%">Бухгалтер:</td>
                                                        <td class="text-right">Янов С.А.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        
                                        </div>	<!-- end print-area -->

                                    </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>