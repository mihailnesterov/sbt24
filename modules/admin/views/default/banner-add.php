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
                                                                <?php $goback = 'javascript:history.go(-1)'; ?>
                                                                <?= Html::a('<i class="fa fa-arrow-left"></i>', $parentURL, ['class' => 'go-back-link', 'title' => $parentName]) ?><?= Html::encode($this->title) ?>
                                                        </h1>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">
                                                                <?php $form = ActiveForm::begin(); ?>
                                                                <div class="col-md-6">
                                                                        
                                                                        <?= $form->field($model, 'name', [
                                                                                'template' => '{label}{input}{error}',
                                                                                'inputOptions' => [
                                                                                'autofocus' => 'autofocus',
                                                                                'tabindex' => '1',
                                                                                'placeholder' => 'Название баннера',
                                                                                'class'=>'form-control',
                                                                                ]
                                                                        ])->label('Название баннера') ?>
                                                                        
                                                                        <p>Картинка баннера</p>
                                                                        <div id="banner-image-block">
                                                                                <?= Html::img(
                                                                                        '@web/images/banners/'.$model->image, 
                                                                                        [
                                                                                                'alt' => $model->name,
                                                                                                'id' => 'banner-image',
                                                                                                'class' => 'img-responsive'
                                                                                        ]
                                                                                ) ?>

                                                                                
                                                                                <?= $form->field($model, 'image', [
                                                                                        'template' => '{label}{input}{error}',
                                                                                        'inputOptions' => [
                                                                                        'type' => 'hidden',
                                                                                        'id' => 'input-image-file',
                                                                                        'autofocus' => 'autofocus',
                                                                                        'tabindex' => '2',
                                                                                        'placeholder' => 'Загрузите картинку',
                                                                                        'class'=>'form-control',
                                                                                        ]
                                                                                ])->label(false) ?>

                                                                                <?= $form->field($model, 'imageFile')->fileInput([
                                                                                        'id' => 'input-load-image', 
                                                                                        'class'=>'form-control hidden',
                                                                                ])->label(false); ?>
                                                                                
                                                                                <div id="btn-block">
                                                                                        <?= Html::button('Загрузить картинку', ['id' => 'btn-load-image','class' => 'btn btn-default']) ?>
                                                                                </div>
                                                                        </div> <!--  end banner-image-block -->
                                                                </div>	<!-- end col -->
                                                                <div class="col-md-6">
                                                                        <?php 
                                                                                $items = [
                                                                                        1 => 'Слайдер на главной',
                                                                                        2 => 'Баннер на главной',
                                                                                        3 => 'Баннер в каталоге',
                                                                                        4 => 'Баннер в левом меню',
                                                                                ];
                                                                                $params = [
                                                                                        'prompt' => 'Выберите позицию',
                                                                                        'id' => 'select-banner-position'
                                                                                ];
                                                                                echo $form->field($model, 'position')->dropDownList($items, $params)->label('Позиция') ;
                                                                        ?>
                                                                        
                                                                        <p id="position-comment" class="bg-warning"></p>
                                                                        
                                                                        <?= $form->field($model, 'link', [
                                                                                'template' => '{label}{input}{error}',
                                                                                'inputOptions' => [
                                                                                'autofocus' => 'autofocus',
                                                                                'tabindex' => '3',
                                                                                'placeholder' => 'Ссылка на товар (категорию, страницу)',
                                                                                'class'=>'form-control',
                                                                                ]
                                                                        ])->label('Ссылка на товар (категорию, страницу)') ?>
                                                                        <p class="bg-warning">Ссылка на любую страницу сайта, по которой будет переход с баннера</p>
                                                                        
                                                                </div>	<!-- end col -->
                                                                <div class="col-xs-12 btn-block">
                                                                        <hr>
                                                                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                                                                </div>  <!-- end col -->
                                                                <?php ActiveForm::end(); ?>

                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>