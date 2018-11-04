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
                                            
                                            <?php
                                                echo $model->name.'<br>';
                                                echo '<img src="images/tovar1.jpg" alt="'.$model->name.'" class="img-responsive"><br>';
                                                echo $model->text.'<br>';
                                                echo $model->brand.'<br>';
                                                echo $model->type.'<br>';
                                                echo $model->model.'<br>';
                                                echo $model->garantee.'<br>';
                                                
                                                if ($model->price_rub != 0) { 
                                                    $price = $model->price_rub;
                                                } 
                                                if ($model->price_usd != 0) {
                                                    $price = $model->price_usd * Yii::$app->controller->getCBRdata('currency')->Valute->USD->Value;
                                                } 
                                                if ($model->price_eur != 0) {
                                                    $price = $model->price_eur * Yii::$app->controller->getCBRdata('currency')->Valute->EUR->Value;
                                                }
                                                echo 'Цена: '.round($price).' руб.<br>';
                                                
                                            ?>
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
                                            </div>	<!-- end content-block -->
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>