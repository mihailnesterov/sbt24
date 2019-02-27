<?php

/* 
 * view (tovar) page
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
                            echo $this->render('_aside');
                        ?>

                        <div class="col-sm-7 col-md-8">
                                <div id="content-container">

                                        <div class="content-block">
                                            <header>
                                                <h1><?= Html::encode($this->title) ?></h1>
                                                <span id="goods-id" class="hidden"><?= $model->id ?></span>
                                            </header>
                                            
                                            <div class="goods-container">	
                                                <div class="row">
                                                    <div class="goods-view-block">
                                                            <div class="goods-view-img-block col-md-4 col-lg-4">
                                                                <img src="images/goods/<?= $model->photo1 ?>" alt="<?= $model->name ?>" class="img-responsive">
                                                                <?= $hit ?>
                                                                <?= $discount ?>
                                                            </div>  <!-- end col -->
                                                            
                                                            <div class="col-md-8 col-lg-8">
                                                                <?php /*yii\widgets\Pjax::begin([
                                                                    'id' => 'addToCartFromViewPjax',
                                                                    'timeout' => 0
                                                                    ]) */
                                                                ?>
                                                                <?php $form = ActiveForm::begin(/*['options' => ['data-pjax' => true]]*/); ?>
                                                                    <div class="row">                                                                    
                                                                        <i class="goods-price col-md-6"><s><?= $old_price ?></s><span><?= $price ?></span> &#8381;</i>
                                                                       <?= $form->field($client, 'company')
                                                                            ->textInput(['type' => 'hidden'])
                                                                            ->label(false) ?>
                                                                        <?= Html::submitButton('<i class="fa fa-shopping-cart"></i> В корзину', ['class' => 'goods-buy buy-from-view col-md-5']) ?>
                                                                    </div> <!-- end row -->
                                                                <?php ActiveForm::end(); ?>
                                                                <?php //yii\widgets\Pjax::end(); ?>
                                                                
                                                                <br>
                                                                
                                                                <table id="goods-view-table" class="table table-bordered table-striped">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Бренд</td>
                                                                            <td><?= $model->brand ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Тип</td>
                                                                            <td><?= $model->type ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Модель</td>
                                                                            <td><?= $model->model ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Гарантия (мес)</td>
                                                                            <td><?= $model->garantee ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                
                                                                
                                                            </div>  <!-- end col -->
                                                        
                                                        <div class="goods-view-tabs col-xs-12">

                                                            <!-- Tabs navigation -->  
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Описание</a></li>
                                                                <li role="presentation"><a href="#feature" aria-controls="feature" role="tab" data-toggle="tab">Характеристики</a></li>
                                                                <li role="presentation"><a href="#ability" aria-controls="ability" role="tab" data-toggle="tab">Возможности</a></li>
                                                                <li role="presentation"><a href="#advantage" aria-controls="advantage" role="tab" data-toggle="tab">Преимущества</a></li>
                                                            </ul>

                                                            <!-- Tabs content -->  
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="description"><?= $video ?><?= $model->text ?></div>
                                                                <div role="tabpanel" class="tab-pane" id="feature"><?= $model->properties ?></div>
                                                                <div role="tabpanel" class="tab-pane" id="ability"><?= $model->abilities ?></div>
                                                                <div role="tabpanel" class="tab-pane" id="advantage"><?= $model->advantages ?></div>
                                                            </div>

                                                        </div>  <!-- end goods-view-tabs --> 
                                                        
                                                        <div class="social-buttons col-xs-12">
                                                            <script type="text/javascript">(function() {
                                                                if (window.pluso)if (typeof window.pluso.start == "function") return;
                                                                if (window.ifpluso==undefined) { window.ifpluso = 1;
                                                                  var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                                                  s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                                                  s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                                                  var h=d[g]('body')[0];
                                                                  h.appendChild(s);
                                                                }})();</script>
                                                            <div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir"></div>
                                                        </div>	<!-- end social-buttons -->
                                                        
                                                    </div>  <!-- end goods-list-block -->                                                    
                                                </div>	<!-- end row -->
                                            </div>  <!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        <?php foreach ($bannersPos5 as $key => $banner): ?>
                                            <div class="banner-block">
                                                <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
                                            </div><!-- end banner-block -->
                                        <?php endforeach ?>
                                        
                                        <div class="content-block">
                                            <header>
                                                <h2>Другие <?= $category->name ?></h2>
                                            </header>
                                            <!-- Swiper slider main container -->
                                            <div class="swiper-container">
                                                <!-- Swiper slider wrapper -->
                                                <div class="swiper-wrapper">
                                                        <!-- Slides -->
                                                        <?php foreach ($other as $key => $tovar): ?>
                                                            <?php
                                                                if ($tovar->price_rub != 0) { 
                                                                    $price_other = round($tovar->price_rub,2);
                                                                } 
                                                                if ($tovar->price_usd != 0) {
                                                                    $price_other = round(($tovar->price_usd * $currencies['USD']),2);
                                                                } 
                                                                if ($tovar->price_eur != 0) {
                                                                    $price_other = round(($tovar->price_eur * $currencies['EUR']),2);
                                                                }
                                                                if ($tovar->discount != 0) {
                                                                    $discount_other = '<div class="label discount"><span class="flash animated">'.$tovar->discount.'%</span></div>';
                                                                    $old_price_other = round($price_other,2);
                                                                    $price_other = round(($price_other - $price_other/100*$tovar->discount),2);
                                                                } else {
                                                                    $discount_other = '';
                                                                    $old_price_other = '';
                                                                }
                                                            ?>
                                                        <div class="swiper-slide" data-swiper-autoplay="5000">
                                                            <div class="goods-container">
                                                                <div class="goods-view-block row">
                                                                    
                                                                    <div class="col-sm-8">
                                                                            <h3><?= $tovar->name ?></h3>
                                                                            <br>
                                                                            <div class="text-left" style="text-overflow: ellipsis; word-wrap: break-word; overflow: hidden; max-height: 84px;">
                                                                                <?= $tovar->text ?>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row">
                                                                            <div class="goods-price col-lg-9">
                                                                                <s><?= $old_price_other ?></s><span><?= $price_other ?></span> &#8381;
                                                                            </div>
                                                                            <div class="col-lg-3">
                                                                                <?= Html::a('Подробнее', Yii::$app->urlManager->createUrl(['view?id='.$tovar->id]), ['class' => 'goods-buy']) ?>
                                                                            </div>
                                                                            </div>
                                                                    </div>  <!-- end col -->
                                                                    <div class="goods-view-img-block col-sm-4">
                                                                        
                                                                        <?= Html::a('<img src="images/goods/'.$tovar->photo1.'" alt="" class="img-responsive">', Yii::$app->urlManager->createUrl(['view?id='.$tovar->id])) ?>
                                                                        <?= $discount_other ?>
                                                                    </div>  <!-- end col -->
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <?php endforeach ?>
                                                </div>
                                                <!-- Swiper slider navigation -->
                                                <div class="swiper-button-prev">
                                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                </div>
                                                <div class="swiper-button-next">
                                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </div>
                                            </div> <!-- end swiper -->
                                            
                                        </div>	<!-- end content-block -->
                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>