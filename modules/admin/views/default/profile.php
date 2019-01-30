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
                                        <h1>
                                            <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin', ['class' => 'go-back-link', 'title' => 'Кабинет']) ?>
                                            <?= Html::encode($this->title) ?>
                                        </h1>
                                        <p class="bg-warning">Информация о пользователе</p>
                                    </header>

                                    <div class="goods-container">	
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <?php $form = ActiveForm::begin(); ?>
                                                <div class="row">
                                                    <div class="form-group col-sm-8">
                                                        <?= $form->field($user, 'login', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                                'autofocus' => 'autofocus',
                                                                'tabindex' => '1',
                                                                'placeholder' => 'Логин',
                                                                'class'=>'form-control'
                                                            ]
                                                        ])->label('Логин') ?>
                                                    </div>
                                                    <div class="form-group col-sm-8">
                                                        <?= $form->field($user, 'email', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                                'autofocus' => 'autofocus',
                                                                'tabindex' => '2',
                                                                'placeholder' => 'Email',
                                                                'class'=>'form-control'
                                                            ]
                                                        ])->label('Email') ?>
                                                    </div>
                                                </div>	<!-- end row -->

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