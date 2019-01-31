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
                                            <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin/categories', ['class' => 'go-back-link', 'title' => 'Категории товаров']) ?>
                                            <?= Html::encode($this->title) ?>
                                        </h1>
                                        <p class="bg-warning">Редактирование категории...</p>
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
                                                            'placeholder' => $model->getAttributeLabel('name'),
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label($model->getAttributeLabel('name')) ?>
                                                    
                                                    <p>Картинка категории</p>
                                                    <div id="banner-image-block">
                                                        <?= Html::img(
                                                            '@web/images/catalog/'.$model->image, 
                                                            [
                                                                //'alt' => 'Загрузите картинку',
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
                                                        
                                                        $params = [
                                                                'prompt' => 'Нет',
                                                                //'id' => 'select-banner-position'
                                                                'id' => 'select-parent-category',
                                                                'class' => 'form-control',
                                                        ];
                                                        echo $form->field($model, 'parent')->dropDownList($items, $params)->label('Родительская категория') ;
                                                ?>

                                                <p class="bg-warning">Если категория не имеет родительской - выберите первый пункт "Нет"</p>
                                                
                                                <?= $form->field($model, 'link', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '3',
                                                        'placeholder' => $model->getAttributeLabel('link'),
                                                        'class'=>'form-control',
                                                        ]
                                                ])->label($model->getAttributeLabel('link')) ?>
                                                
                                                <p class="bg-warning">Ссылка в адресной строке генерируется автоматически из имени категории</p>
                                                    
                                            </div>	<!-- end col -->
                                            
                                            <div class="col-xs-12">
                                                <p class="bg-warning">SEO-теги: title, keywords, descriptions</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <?= $form->field($model, 'title', [
                                                                'template' => '{label}{input}{error}',
                                                                'inputOptions' => [
                                                                'autofocus' => 'autofocus',
                                                                'tabindex' => '4',
                                                                'placeholder' => $model->getAttributeLabel('title'),
                                                                'class'=>'form-control',
                                                                ]
                                                        ])->label($model->getAttributeLabel('title')) ?>

                                                        <?= $form->field($model, 'keywords', [
                                                                'template' => '{label}{input}{error}',
                                                                'inputOptions' => [
                                                                'autofocus' => 'autofocus',
                                                                'tabindex' => '5',
                                                                'placeholder' => $model->getAttributeLabel('keywords'),
                                                                'class'=>'form-control',
                                                                ]
                                                        ])->label($model->getAttributeLabel('keywords')) ?>
                                                    </div>	<!-- end col -->
                                                    <div class="col-md-6">
                                                        <?= $form->field($model, 'description')->textArea([
                                                            'template' => '{label}{input}{error}',
                                                            'maxlength' => true,
                                                            'autofocus' => 'autofocus',
                                                            'tabindex' => '6',
                                                            'class' => 'form-control', 
                                                            'rows' => '3', 
                                                            'placeholder' => $model->getAttributeLabel('description'),
                                                            ]
                                                        )->label($model->getAttributeLabel('description'))?>
                                                    </div>	<!-- end col -->
                                                </div>	<!-- end row -->
                                            </div>	<!-- end col -->
                                            
                                            <div class="col-xs-12 btn-block">
                                                    <hr>
                                                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                                                    <?php if($tovarCount == 0): ?>
                                                    <?= Html::a('Удалить', ['/admin/delete-category', 'id' => $model->id], [
                                                            'class' => 'btn btn-danger',
                                                            'title' => 'Удалить',
                                                            'data' => [
                                                                    'confirm' => 'Удалить категорию "'.$model->name.'"?',
                                                                    'method' => 'post',
                                                                    ],
                                                            ]
                                                    ) ?>
                                                    <?php endif; ?>
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