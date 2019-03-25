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
                                            
                                                <h3>Поставщик</h3>
                                            
                                            <table class="table table-responsive table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3"><?= $company->company_name ?></th>
                                                    </tr>   
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $company->address ?></td>
                                                        <td>ИНН <?= $company->inn ?></td>
                                                        <td>КПП <?= $company->kpp ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= $company->bank ?></td>
                                                        <td colspan="2">БИК: <?= $company->bik ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Р/С: <?= $company->account ?></td>
                                                        <td colspan="2">К/С: <?= $company->korr_account ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                                
                                        </div>	<!-- end content-block -->
                                        
                                        <div class="content-block">
                                                
                                            <h3>Покупатель</h3>
                                            
                                            <p class="text-info bg-warning" style="padding: 1.5em; margin: 1em 0 2em 0;">Для получения счета на оплату укажите реквизиты вашей компании:</p>
                                            <?php $form = ActiveForm::begin(); ?>
                                            <table class="table table-responsive table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="50%">
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'company', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '1',
                                                                        'placeholder' => 'Название компании',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'contact', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '2',
                                                                        'placeholder' => 'Контактное лицо',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'phone', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '3',
                                                                        'placeholder' => 'Телефон',
                                                                        'class'=>'form-control',
                                                                        //'pattern'=>'\D+([a-zA-Z0-9._@])$'
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                        <td colspan="2">
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'email', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '4',
                                                                        'placeholder' => 'Email',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'address', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '5',
                                                                        'placeholder' => 'Юр. адрес',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'inn', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '6',
                                                                        'placeholder' => 'ИНН',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?= $form->field($client, 'kpp', [
                                                                    'template' => '{input}{error}',
                                                                    'inputOptions' => [
                                                                        'autofocus' => 'autofocus',
                                                                        'tabindex' => '7',
                                                                        'placeholder' => 'КПП',
                                                                        'class'=>'form-control',
                                                                    ]
                                                                ])->label(false) ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>	<!-- end content-block -->
                                        
                                        <div class="content-block">
                                            
                                            <h3>Товары (работы, услуги)</h3>
                                            
                                            <table id="cart-table" class="table table-responsive table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="7%" class="text-center">№</th>
                                                        <th class="text-center">Наименование</th>
                                                        <th width="10%" class="text-center">Кол-во</th>
                                                        <th width="18%" class="text-center">Цена, руб.</th>
                                                        <th width="18%" class="text-center">Сумма, руб.</th>
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
                                                            .'<td  class="text-center">'
                                                            .($itemCount+1)        
                                                            .'</td>'
                                                            /*.'<td width="12%" class="text-center">'
                                                            .Html::a('<img src="images/tovar1.jpg" alt="" class="img-responsive">', [\Yii::$app->urlManager->createUrl('../view?id='.$tovar->id)])
                                                            .'</td>'*/
                                                            .'<td>'
                                                            .Html::a($tovar->name, [\Yii::$app->urlManager->createUrl('../view?id='.$tovar->id)], ['class' => 'name-cart-item'])
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .$item->count
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .$price
                                                            .'</td>'
                                                            .'<td class="text-center">'
                                                            .$sum
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            <p class="text-info bg-warning" style="padding: 1.5em; margin: 2em 0;">Внимание! Если вы хотите изменить ваш заказ - нажмите "Вернуться в корзину". После того, как вы нажмете кнопку "Оплатить счет", будет сформирован счет на оплату, при этом, все выбранные товары будут удалены из корзины</p>
                                            
                                            <div class="form-group text-center row">
                                                <div class="text-left col-xs-6">
                                                    <?= Html::a('<i class="fa fa-chevron-left" aria-hidden="true"></i> Вернуться в корзину', 'javascript:history.go(-1)', ['class' => 'btn btn-link text-right', 'title' => 'Вернуться на предыдущую страницу']) ?>
                                                </div>
                                                <div class="text-right col-xs-6">
                                                    <?= Html::submitButton('Оплатить счет', ['class' => 'btn btn-success btn-lg']) ?>
                                                </div>
                                            </div>
                                        <?php ActiveForm::end(); ?>    
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>