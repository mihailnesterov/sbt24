<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                    <!--<h2 class="breadcrumb">СПЕЦБАНКТЕХНИКА - поставка специализированного банковского оборудования в Красноярске</h2>-->
                                </div>
                            <br>
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

                                        <!-- Swiper slider main container -->
                                        <div class="swiper-container">
                                                <!-- Swiper slider wrapper -->
                                                <div class="swiper-wrapper">
                                                        <!-- Slides -->
                                                        <?php foreach ($bannersPos1 as $banner): ?>
                                                        <section class="swiper-slide" data-swiper-autoplay="3000">
                                                                <?= Html::a('<img src="images/banners/'.$banner->image.'" alt="'.$banner->name.'" class="img-responsive">', $banner->link) ?>
                                                        </section>
                                                        <?php endforeach; ?>
                                                </div>
                                                <!-- Swiper slider pagination -->
                                                <div class="swiper-pagination"></div>
                                                <!-- Swiper slider navigation -->
                                                <div class="swiper-button-prev">
                                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                </div>
                                                <div class="swiper-button-next">
                                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </div>
                                        </div> <!-- end swiper -->


                                        <div class="content-block">
                                                <header>
                                                        <h2>Новые товары</h2>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">
                                                        
                                                            <?php
                                                            // вывод 3-х последних новинок
                                                                foreach ($newTovar as $new):
                                                                    if ($new->price_rub != 0) { 
                                                                    $price = round($new->price_rub,2);
                                                                    } 
                                                                    if ($new->price_usd != 0) {
                                                                        $price = round(($new->price_usd * $currencies['USD']),2);
                                                                    } 
                                                                    if ($new->price_eur != 0) {
                                                                        $price = round(($new->price_eur * $currencies['EUR']),2);
                                                                    }
                                                                    if ($new->discount != 0) {
                                                                        $discount = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$new->id).'" class="label discount"><span class="flash animated">'.$new->discount.'%</span></a>';
                                                                        $old_price = round($price,2);
                                                                        $price = round(($price - $price/100*$new->discount),2);
                                                                    } else {
                                                                        $discount = '';
                                                                        $old_price = '';
                                                                    }
                                                                    echo '<div class="col-sm-12 col-lg-4">'
                                                                        . '<div class="goods-block">'
                                                                        . Html::a('<img src="images/goods/'.$new->photo1.'" alt="'.$new->model.'" class="img-responsive">', [Yii::$app->homeUrl.'../view?id='.$new->id])
                                                                        . '<h4>'.$new->name.'</h4>'
                                                                        . '<p class="goods-price"><span>'.$price.'</span> &#8381;</p>'
                                                                        . Html::button('<i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину', ['class' => 'goods-buy buy-from-preview'])
                                                                        . '</div>    <!-- end goods-block -->'
                                                                        . Html::a('<span><i class="fa fa-eye" aria-hidden="true"></i></span>', [Yii::$app->homeUrl.'../view?id='.$new->id], ['class' => 'label'])    
                                                                        . '</div>    <!-- end col -->';
                                                                endforeach;
                                                            ?>
                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        <div id="banner-pos-2">
                                                <?php foreach ($bannersPos2 as $banner): ?>
                                                        <?= Html::a('<img src="images/banners/'.$banner->image.'" alt="'.$banner->name.'" class="img-responsive">', $banner->link) ?>
                                                <?php endforeach; ?>
                                        </div>

                                        <div class="content-block">
                                                <header>
                                                        <h2>Хиты продаж</h2>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">
                                                            
                                                                <?php
                                                                // вывод 3-х хитов продаж
                                                                    foreach ($hitTovar as $hit):
                                                                        if ($hit->price_rub != 0) { 
                                                                        $price = round($hit->price_rub,2);
                                                                        } 
                                                                        if ($hit->price_usd != 0) {
                                                                            $price = round(($hit->price_usd * $currencies['USD']),2);
                                                                        } 
                                                                        if ($hit->price_eur != 0) {
                                                                            $price = round(($hit->price_eur * $currencies['EUR']),2);
                                                                        }
                                                                        if ($hit->discount != 0) {
                                                                            $discount = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$hit->id).'" class="label discount"><span class="flash animated">'.$hit->discount.'%</span></a>';
                                                                            $old_price = round($price,2);
                                                                            $price = round(($price - $price/100*$hit->discount),2);
                                                                        } else {
                                                                            $discount = '';
                                                                            $old_price = '';
                                                                        }
                                                                        echo '<div class="col-sm-12 col-lg-4">'
                                                                            . '<div class="goods-block">'
                                                                            . Html::a('<img src="images/goods/'.$hit->photo1.'" alt="'.$hit->model.'" class="img-responsive">', [Yii::$app->homeUrl.'../view?id='.$hit->id])
                                                                            . '<h4>'.$hit->name.'</h4>'
                                                                            . '<p class="goods-price"><span>'.$price.'</span> &#8381;</p>'
                                                                            . Html::button('<i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину', ['class' => 'goods-buy buy-from-preview'])
                                                                            . '</div>    <!-- end goods-block -->'
                                                                            . Html::a('<span><i class="fa fa-star-o" aria-hidden="true"></i></span>', [Yii::$app->homeUrl.'../view?id='.$hit->id], ['class' => 'label'])    
                                                                            . '</div>    <!-- end col -->';
                                                                    endforeach;
                                                                ?>
                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        <div class="content-block">
                                                <header>
                                                        <h2>Бренды</h2>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block" style="min-height: 120px;">
                                                                                <img src="images/brands/dors.png" alt="" class="img-responsive">
                                                                        </div>
                                                                </div>	<!-- end col -->
                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block" style="min-height: 120px;">
                                                                                <img src="images/brands/ctcoin.png" alt="" class="img-responsive">
                                                                        </div>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block" style="min-height: 120px;">
                                                                                <img src="images/brands/magner.png" alt="" class="img-responsive">
                                                                        </div>
                                                                </div>	<!-- end col -->


                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->

                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>