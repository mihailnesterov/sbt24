<?php

use mihaildev\ckeditor\CKEditor;
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
                                    <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin/goods', ['class' => 'go-back-link', 'title' => 'Товары']) ?>
                                    <?= Html::encode($this->title) ?>
                                </h1>
                                <p class="bg-warning">Добавление товара. Обязательные поля: название товара, категория, описание товара, картинка №1.</p>
                            </header>

                            <div class="goods-container">	
                                <div class="dashboard row">
                                    <div class="col-xs-12">
                                        <div class="dashboard-block">
                                            <div class="goods-pagination-block">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <?php $tabCounter = 0; ?>
                                                    <?= Html::button(
                                                        'Все',
                                                        [
                                                            'class' => 'btn btn-default active',
                                                            'tab' => $tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'Тексты',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'Картинки',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'Цены',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'Характеристики',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'Файлы',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                    <?= Html::button(
                                                        'SEO',
                                                        [
                                                            'class' => 'btn btn-default',
                                                            'tab' => ++$tabCounter
                                                        ]
                                                    )?>
                                                </div>
                                            </div> <!-- end-category-filter-block -->
                                        </div> <!-- end-dashboard-block -->
                                    </div> <!-- end-col -->

                                    <?php $form = ActiveForm::begin(); ?>
                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 col-md-8">
                                                    <?= $form->field($model, 'name', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                            'autofocus' => 'autofocus',
                                                            'tabindex' => '1',
                                                            'placeholder' => $model->getAttributeLabel('name'),
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label($model->getAttributeLabel('name')) ?>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <?php
                                                        $params = [
                                                                'prompt' => 'Выберите категорию',
                                                                'id' => 'select-goods-category',
                                                                'autofocus' => 'autofocus',
                                                                'tabindex' => '2',
                                                                'class' => 'form-control',
                                                        ];
                                                        echo $form->field($model, 'category_id')->dropDownList($catItems, $params)->label('Категория') ;
                                                    ?>
                                                </div> <!-- end-col -->
                                            </div> <!-- end-row -->
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="3">
                                            <h5>Цены и скидки</h5>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <p class="bg-warning">Цена должна быть указана только в одной из валют! Другие цены должны быть = 0. Если цена товара в рублях - она будет опубликована на сайте. Если цена указана в USD или EUR, то она будет пересчитываться в рубли по текущему курсу. Пользователь в любом случае увидит цены только в рублях</p>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-4">                                        
                                                    <?= $form->field($model, 'price_rub', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '3',
                                                        'placeholder' => $model->getAttributeLabel('price_rub'),
                                                        'value' => '0.00',
                                                        'class'=>'form-control',
                                                        ]
                                                    ])->label($model->getAttributeLabel('price_rub')) ?>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-4">                                                           
                                                    <?= $form->field($model, 'price_usd', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '4',
                                                        'placeholder' => $model->getAttributeLabel('price_usd'),
                                                        'value' => '0.00',
                                                        'class'=>'form-control',
                                                        ]
                                                    ])->label($model->getAttributeLabel('price_usd')) ?>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-4">                                                           
                                                    <?= $form->field($model, 'price_eur', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '5',
                                                        'placeholder' => $model->getAttributeLabel('price_eur'),
                                                        'value' => '0.00',
                                                        'class'=>'form-control',
                                                        ]
                                                    ])->label($model->getAttributeLabel('price_eur')) ?>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12">
                                                    <p class="bg-warning">Если на товар действует скидка - укажите размер скидки в %. Если влючена опция "Хит-продаж" - товар будет показан в соответствующем блоке на сайте</p>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-4">                                                           
                                                    <?= $form->field($model, 'discount', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '6',
                                                        'placeholder' => $model->getAttributeLabel('discount'),
                                                        'class'=>'form-control',
                                                        ]
                                                    ])->label($model->getAttributeLabel('discount')) ?>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-4">
                                                    <div class="checkbox" style="padding-left: 0.5em; padding-top: 1.2em;">
                                                    <?= $form->field($model, 'hit')->checkbox([
                                                        'template' => '{label}{input}{error}',
                                                        'id' => 'goods-hit-checkbox',
                                                        'label' => $model->getAttributeLabel('hit'),
                                                        'class' => 'checkbox',
                                                    ]) ?>
                                                    </div>
                                                </div> <!-- end-col -->
                                            </div> <!-- end-row -->
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->
                                    
                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="2">
                                            <h5>Картинки товара</h5>
                                            <p class="bg-warning">Загрузите изображения товара - до 4-х шт. Картинка №1 должна быть загружена обязательно</p>
                                            <div class="row" style="padding: 1em;">
                                                <div class="goods-image-block col-md-3">
                                                    <?= Html::img(
                                                        '@web/images/image.png', 
                                                        [
                                                                'alt' => '',
                                                                'id' => 'goods-image-1',
                                                                'class' => 'img-responsive'
                                                        ]
                                                    ) ?>
                                                    <?= $form->field($model, 'photo1', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                            'type' => 'hidden',
                                                            'id' => 'input-image-photo-1',
                                                            'placeholder' => 'Загрузите картинку',
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label(false) ?>
                                                    <?= $form->field($model, 'photoFile1')->fileInput([
                                                            'id' => 'input-load-photo-1', 
                                                            'class'=>'form-control hidden',
                                                    ])->label(false); ?>
                                                        
                                                    <div id="btn-block text-center">
                                                            <?= Html::button('Загрузить', ['id' => 'btn-load-photo1','class' => 'btn btn-default']) ?>
                                                    </div>
                                                </div> <!--  end goods-image-block -->

                                                <div class="goods-image-block col-md-3">
                                                    <?= Html::img(
                                                        '@web/images/image.png', 
                                                        [
                                                                'alt' => '',
                                                                'id' => 'goods-image-2',
                                                                'class' => 'img-responsive'
                                                        ]
                                                    ) ?>
                                                    <?= $form->field($model, 'photo2', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                            'type' => 'hidden',
                                                            'id' => 'input-image-photo-2',
                                                            'placeholder' => 'Загрузите картинку',
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label(false) ?>
                                                    <?= $form->field($model, 'photoFile2')->fileInput([
                                                            'id' => 'input-load-photo-2', 
                                                            'class'=>'form-control hidden',
                                                    ])->label(false); ?>
                                                        
                                                    <div id="btn-block text-center">
                                                            <?= Html::button('Загрузить', ['id' => 'btn-load-photo2','class' => 'btn btn-default']) ?>
                                                    </div>
                                                </div> <!--  end goods-image-block -->

                                                <div class="goods-image-block col-md-3">
                                                    <?= Html::img(
                                                        '@web/images/image.png', 
                                                        [
                                                                'alt' => '',
                                                                'id' => 'goods-image-3',
                                                                'class' => 'img-responsive'
                                                        ]
                                                    ) ?>
                                                    <?= $form->field($model, 'photo3', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                            'type' => 'hidden',
                                                            'id' => 'input-image-photo-3',
                                                            'placeholder' => 'Загрузите картинку',
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label(false) ?>
                                                    <?= $form->field($model, 'photoFile3')->fileInput([
                                                            'id' => 'input-load-photo-3', 
                                                            'class'=>'form-control hidden',
                                                    ])->label(false); ?>
                                                        
                                                    <div id="btn-block text-center">
                                                            <?= Html::button('Загрузить', ['id' => 'btn-load-photo3','class' => 'btn btn-default']) ?>
                                                    </div>
                                                </div> <!--  end goods-image-block -->

                                                <div class="goods-image-block col-md-3">
                                                    <?= Html::img(
                                                        '@web/images/image.png', 
                                                        [
                                                                'alt' => '',
                                                                'id' => 'goods-image-4',
                                                                'class' => 'img-responsive'
                                                        ]
                                                    ) ?>
                                                    <?= $form->field($model, 'photo4', [
                                                            'template' => '{label}{input}{error}',
                                                            'inputOptions' => [
                                                            'type' => 'hidden',
                                                            'id' => 'input-image-photo-4',
                                                            'placeholder' => 'Загрузите картинку',
                                                            'class'=>'form-control',
                                                            ]
                                                    ])->label(false) ?>
                                                    <?= $form->field($model, 'photoFile4')->fileInput([
                                                            'id' => 'input-load-photo-4', 
                                                            'class'=>'form-control hidden',
                                                    ])->label(false); ?>
                                                        
                                                    <div id="btn-block text-center">
                                                            <?= Html::button('Загрузить', ['id' => 'btn-load-photo4','class' => 'btn btn-default']) ?>
                                                    </div>
                                                </div> <!--  end goods-image-block -->

                                            </div>	<!-- end row -->
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="1">
                                            <?= $form->field($model, 'text')->widget(
                                                CKEditor::className(),
                                                [
                                                'editorOptions' => [
                                                    'preset' => 'standard', // basic, standard, full
                                                    'inline' => false,      //по умолчанию false
                                                ],
                                                ])->textArea([
                                                'template' => '{label}{input}{error}',
                                                'maxlength' => true,
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '8',
                                                'rows' => '5', 
                                                'placeholder' => $model->getAttributeLabel('text'),
                                                'class'=>'form-control',
                                            ])->label($model->getAttributeLabel('text')) ?>
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="1">
                                            <?= $form->field($model, 'video', [
                                                    'template' => '{label}{input}{error}',
                                                    'inputOptions' => [
                                                    'autofocus' => 'autofocus',
                                                    'tabindex' => '9',
                                                    'placeholder' => 'Ссылка на видео с Youtube - скопируйте код после ?v=',
                                                    'class'=>'form-control',
                                                    ]
                                            ])->label($model->getAttributeLabel('video')) ?>
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="4">
                                            <h5>Характеристики товара</h5>
                                            <p class="bg-warning">Технические характеристики товара: бренд, модель, гарантия, преимущества и т.д.</p>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <?= $form->field($model, 'brand', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '10',
                                                        'placeholder' => $model->getAttributeLabel('brand'),
                                                        'class'=>'form-control',
                                                        'id' => 'brand-field',
                                                        ]
                                                    ])->label($model->getAttributeLabel('brand')) ?>
                                                    <span class="dropdown">
                                                        <a id="brand-menu-link" class="hidden" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-down"></i></a>
                                                        <ul id="brand-dropdown-menu" class="dropdown-menu" aria-labelledby="brand-menu-link">
                                                            <?php foreach ($brands as $brand):?>
                                                                <li><?= $brand->brand ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </span>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($model, 'type', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '11',
                                                        'placeholder' => $model->getAttributeLabel('type'),
                                                        'class'=>'form-control',
                                                        'id' => 'type-field',
                                                        ]
                                                    ])->label($model->getAttributeLabel('type')) ?>
                                                    <span class="dropdown">
                                                        <a id="type-menu-link" class="hidden" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-down"></i></a>
                                                        <ul id="type-dropdown-menu" class="dropdown-menu" aria-labelledby="type-menu-link">
                                                            <?php foreach ($types as $type):?>
                                                                <li><?= $type->type ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </span>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($model, 'model', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '12',
                                                        'placeholder' => $model->getAttributeLabel('model'),
                                                        'class'=>'form-control',
                                                        'id' => 'model-field',
                                                        ]
                                                    ])->label($model->getAttributeLabel('model')) ?>
                                                </div>
                                                <div class="col-sm-3">
                                                    <?= $form->field($model, 'garantee', [
                                                        'template' => '{label}{input}{error}',
                                                        'inputOptions' => [
                                                        'autofocus' => 'autofocus',
                                                        'tabindex' => '13',
                                                        'placeholder' => $model->getAttributeLabel('garantee'),
                                                        'class'=>'form-control',
                                                        ]
                                                    ])->label($model->getAttributeLabel('garantee')) ?>
                                                </div>
                                            </div>
                                            <?= $form->field($model, 'properties')->widget(
                                                CKEditor::className(),
                                                [
                                                'editorOptions' => [
                                                    'preset' => 'standard', // basic, standard, full
                                                    'inline' => false,      //по умолчанию false
                                                ],
                                                ])->textArea([
                                                'template' => '{label}{input}{error}',
                                                'maxlength' => true,
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '14',
                                                'rows' => '5', 
                                                'placeholder' => $model->getAttributeLabel('properties'),
                                                'class'=>'form-control',
                                            ])->label($model->getAttributeLabel('properties')) ?>
                                            
                                            <?= $form->field($model, 'abilities')->widget(
                                                CKEditor::className(),
                                                [
                                                'editorOptions' => [
                                                    'preset' => 'standard', // basic, standard, full
                                                    'inline' => false,      //по умолчанию false
                                                ],
                                                ])->textArea([
                                                'template' => '{label}{input}{error}',
                                                'maxlength' => true,
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '15',
                                                'rows' => '5', 
                                                'placeholder' => $model->getAttributeLabel('abilities'),
                                                'class'=>'form-control',
                                            ])->label($model->getAttributeLabel('abilities')) ?>

                                            <?= $form->field($model, 'advantages')->widget(
                                                CKEditor::className(),
                                                [
                                                'editorOptions' => [
                                                    'preset' => 'standard', // basic, standard, full
                                                    'inline' => false,      //по умолчанию false
                                                ],
                                                ])->textArea([
                                                'template' => '{label}{input}{error}',
                                                'maxlength' => true,
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '16',
                                                'rows' => '5', 
                                                'placeholder' => $model->getAttributeLabel('advantages'),
                                                'class'=>'form-control',
                                            ])->label($model->getAttributeLabel('advantages')) ?>
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->
                                    
                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="5">
                                            <h5>Прикрепить файлы</h5>
                                            <p class="bg-warning">Загрузите файлы в формате pdf (презентации, руководства и т.д.) - до 4 шт.</p>
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12">
                                        <div class="dashboard-block" tab="6">
                                            <h5>SEO</h5>
                                            <p class="bg-warning">МЕТА-теги keywords и description - важная информация для поисковых систем и продвижения. Ключевые слова формируются автоматически при заполнении полей "Тип" и "Модель". Description - это краткое описание страницы, обычно оно совпадает с первым абзацем описания товара. Максимальная длина keywords и description - 255 символов</p>
                                            <?= $form->field($model, 'keywords', [
                                                'template' => '{label}{input}{error}',
                                                'inputOptions' => [
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '21',
                                                'placeholder' => $model->getAttributeLabel('keywords'),
                                                'class'=>'form-control',
                                                'id' => 'keywords-field',
                                                ]
                                            ])->label($model->getAttributeLabel('keywords')) ?>
                                            <?= $form->field($model, 'description')->textArea([
                                                'template' => '{label}{input}{error}',
                                                'maxlength' => true,
                                                'autofocus' => 'autofocus',
                                                'tabindex' => '22',
                                                'rows' => '5', 
                                                'placeholder' => $model->getAttributeLabel('description'),
                                                'class'=>'form-control',
                                            ])->label($model->getAttributeLabel('description')) ?>
                                        </div> <!-- end dashboard-block -->
                                    </div>	<!-- end col -->

                                    <div class="col-xs-12 btn-block">
                                            <hr>
                                            <?= Html::a('<i class="fa fa-arrow-left"></i>  Вернуться в список товаров', '@web/admin/goods', ['class' => 'btn btn-default']) ?>
                                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                                    </div>  <!-- end col -->
                                <?php ActiveForm::end(); ?>

                                </div>	<!-- end dashboard row -->                                                        
                            </div>	<!-- end goods-container -->

                        </div>	<!-- end content-block -->
                    </div>	<!-- end content-container -->
                </div>	<!-- end col -->

            </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>