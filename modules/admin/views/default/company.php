<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
                                                        <div class="col-xs-12">
                                                            <?php $form = ActiveForm::begin(); ?>
                                                            
                                                            <table class="table table-responsive table-bordered">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="2" class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'name', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '1',
                                                                                        'placeholder' => 'Название (в шапке сайта)',
                                                                                        'class'=>'form-control'
                                                                                    ]
                                                                                ])->label('Название (в шапке сайта)') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'company_name', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '2',
                                                                                        'placeholder' => 'Юр. название',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('Юр. название') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'address', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '3',
                                                                                        'placeholder' => 'Физ. адрес',
                                                                                        'class'=>'form-control',
                                                                                        //'pattern'=>'\D+([a-zA-Z0-9._@])$'
                                                                                    ]
                                                                                ])->label('Физ. адрес') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2" class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'jur_address', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '4',
                                                                                        'placeholder' => 'Юр. адрес',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('Юр. адрес') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td  class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'phone1', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '4',
                                                                                        'placeholder' => 'Телефон',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('Телефон') ?>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                        <td  class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'email', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '6',
                                                                                        'placeholder' => 'Email',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('Email') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td  class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'inn', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '4',
                                                                                        'placeholder' => 'ИНН',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('ИНН') ?>
                                                                            </div>
                                                                        </td>
                                                                        
                                                                        <td  class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'kpp', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '6',
                                                                                        'placeholder' => 'КПП',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('КПП') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'bank', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '1',
                                                                                        'placeholder' => 'Банк',
                                                                                        'class'=>'form-control'
                                                                                    ]
                                                                                ])->label('Банк') ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'bik', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '2',
                                                                                        'placeholder' => 'БИК',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('БИК') ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'account', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '2',
                                                                                        'placeholder' => 'Р/с',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('Р/с') ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="col-sm-4">
                                                                            <div class="form-group">
                                                                                <?= $form->field($company, 'korr_account', [
                                                                                    'template' => '{label}{input}{error}',
                                                                                    'inputOptions' => [
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '2',
                                                                                        'placeholder' => 'К/с',
                                                                                        'class'=>'form-control',
                                                                                    ]
                                                                                ])->label('К/с') ?>
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
                                                        </div>	<!-- end col -->
                                                    </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>