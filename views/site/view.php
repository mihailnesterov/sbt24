<?php

/* 
 * view (tovar) page
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
                                                    <div class="goods-view-block">
                                                            
                                                            <?php
                                                                if ($model->price_rub != 0) { 
                                                                    $price = round($model->price_rub);
                                                                } 
                                                                if ($model->price_usd != 0) {
                                                                    $price = round($model->price_usd * $currencies['USD']);
                                                                } 
                                                                if ($model->price_eur != 0) {
                                                                    $price = round($model->price_eur * $currencies['EUR']);
                                                                }
                                                                if ($model->discount != 0) {
                                                                    $discount = '<div class="label discount"><span class="flash animated">'.$model->discount.'%</span></div>';
                                                                    $old_price = round($price);
                                                                    $price = round($price - $price/100*$model->discount);
                                                                } else {
                                                                    $discount = '';
                                                                    $old_price = '';
                                                                }
                                                                if ($model->hit != 0) {
                                                                    $hit = '<div class="label hit"><span><i class="fa fa-star-o" aria-hidden="true"></i></span></div>';
                                                                } else {
                                                                    $hit = '';
                                                                }
                                                            ?>

                                                            <div class="goods-view-img-block col-md-4 col-lg-4">
                                                                <a href="#"><img src="images/tovar1.jpg" alt="" class="img-responsive"></a>
                                                                <?= $hit ?>
                                                                <?= $discount ?>
                                                            </div>  <!-- end col -->
                                                            
                                                            <div class="col-md-8 col-lg-8">
                                                                
                                                                <div class="row">                                                                    
                                                                    <i class="goods-price col-md-6"><s><?= $old_price ?></s><span><?= $price ?></span> &#8381;</i>
                                                                    <button class="goods-buy col-md-5"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                </div> <!-- end row -->
                                                                
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
                                                        <hr>
                                                        <div class="goods-view-tabs">

                                                            <!-- Tabs navigation -->  
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Описание</a></li>
                                                                <li role="presentation"><a href="#feature" aria-controls="feature" role="tab" data-toggle="tab">Характеристики</a></li>
                                                                <li role="presentation"><a href="#ability" aria-controls="ability" role="tab" data-toggle="tab">Возможности</a></li>
                                                                <li role="presentation"><a href="#advantage" aria-controls="advantage" role="tab" data-toggle="tab">Преимущества</a></li>
                                                            </ul>

                                                            <!-- Tabs content -->  
                                                            <div class="tab-content">
                                                                <div role="tabpanel" class="tab-pane active" id="description"><?= $model->text ?></div>
                                                                <div role="tabpanel" class="tab-pane" id="feature">...</div>
                                                                <div role="tabpanel" class="tab-pane" id="ability">...</div>
                                                                <div role="tabpanel" class="tab-pane" id="advantage">...</div>
                                                            </div>

                                                        </div>  <!-- end goods-view-tabs --> 
                                                        
                                                        <div class="social-buttons">
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

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>