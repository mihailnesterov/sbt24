<?php

/* 
 * order view
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
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
                                            
                                            <p class="text-info bg-warning" style="padding: 1.5em; margin: 1em 0 2em 0;">Укажите реквизиты вашей компании для получения счетов на оплату:</p>
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
                                            <div class="form-group text-center1 row1">
                                                <div class="text-right1 col1-xs-6">
                                                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                                                </div>
                                            </div>
                                        <?php ActiveForm::end(); ?>  

                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>