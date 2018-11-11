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
                                        <div class="swiper-container" style="margin-bottom: 2em;">
                                                <!-- Swiper slider wrapper -->
                                                <div class="swiper-wrapper">
                                                        <!-- Slides -->
                                                        <section class="swiper-slide" data-swiper-autoplay="3000">
                                                                <a href="#"><img src="images/slider1.jpg" alt="" class="img-responsive"></a>
                                                        </section>
                                                        <section class="swiper-slide" data-swiper-autoplay="3000">
                                                                <a href="#"><img src="images/slider2.jpg" alt="" class="img-responsive"></a>
                                                        </section>
                                                        <section class="swiper-slide" data-swiper-autoplay="3000">
                                                                <a href="#"><img src="images/slider3.jpg" alt="" class="img-responsive"></a>
                                                        </section>
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

                                                                <div class="col-sm-12 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar2.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>Двухкарманный счетчик банкнот банковского класса DORS 800</h4>
                                                                                <p class="goods-price"><span>15236</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar3.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>2-х карманный сортировщик банкнот SBM SB-2000Е</h4>
                                                                                <p class="goods-price"><span>13560</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar1.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>Двухкарманная счетно-сортировальная машина с функцией ветхования GLORY USF-51</h4>
                                                                                <p class="goods-price"><span>28963.56</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->

                                                        </div>	<!-- end row -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        <div style="margin-bottom: 2em;">
                                                <a href="#"><img src="images/slider3.jpg" alt="" class="img-responsive"></a>
                                        </div>

                                        <div class="content-block">
                                                <header>
                                                        <h2>Хиты продаж</h2>
                                                </header>

                                                <div class="goods-container">	
                                                        <div class="row">

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar1.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>2-х карманный сортировщик банкнот SBM SB-2000Е</h4>
                                                                                <p class="goods-price"><span>13560</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar2.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>Cортировщик банкнот SBM SB-2000Е</h4>
                                                                                <p class="goods-price"><span>11286</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar3.jpg" alt="" class="img-responsive"></a>
                                                                                <h4>2-х карманный сортировщик банкнот SBM SB-2000Е</h4>
                                                                                <p class="goods-price"><span>22563</span> &#8381;</p>
                                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                        </div>
                                                                        <a href="#" class="label">
                                                                                <span><i class="fa fa-star-o" aria-hidden="true"></i></span>
                                                                        </a>
                                                                </div>	<!-- end col -->


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
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar1.jpg" alt="" class="img-responsive"></a>
                                                                        </div>
                                                                </div>	<!-- end col -->
                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar3.jpg" alt="" class="img-responsive"></a>
                                                                        </div>
                                                                </div>	<!-- end col -->

                                                                <div class="col-sm-6 col-lg-4">
                                                                        <div class="goods-block">
                                                                                <a href="#"><img src="images/tovar2.jpg" alt="" class="img-responsive"></a>
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