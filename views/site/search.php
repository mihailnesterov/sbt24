<?php

/*
 * search page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

mb_internal_encoding('UTF-8');
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
                                                        <h4>Вы искали: "<?= $search ?>", найдено товаров: <?= $tovar_count ?></h4>
                                                </header>
                                                
                                            
                                                <div class="catalog-view-pagination-block">
                                                        <div class="row">
                                                                <div class="col-xs-12 col-md-8">
                                                                        <div class="catalog-view-pagination">
                                                                                <div class="btn-group" role="group">
                                                                                
                                                                                </div>
                                                                        </div>
                                                                </div>  <!-- end col -->
                                                                <div class="col-xs-12 col-md-4 text-right">
                                                                        <div class="btn-group" role="group">                                                       
                                                                                <select id="select-catalog-pages-count" class="form-control">
                                                                                <option value="5">5</option>
                                                                                <option value="10" selected>10</option>
                                                                                <option value="20">20</option>
                                                                                <option value="50">50</option>
                                                                                </select>
                                                                        </div>
                                                                </div>  <!-- end col -->
                                                        </div>  <!-- end row -->
                                                </div>  <!-- end catalog-view-pagination-block -->

                                                <div class="goods-container">	
                                                        <div class="row">
                                                                
                                                                <?php

                                                                $pageNumber = 1;

                                                                foreach ($tovar as $good):
                                                                        if ($good->price_rub != 0) { 
                                                                        $price = round($good->price_rub);
                                                                        } 
                                                                        if ($good->price_usd != 0) {
                                                                        $price = round($good->price_usd * $currencies['USD'],2);
                                                                        } 
                                                                        if ($good->price_eur != 0) {
                                                                        $price = round($good->price_eur * $currencies['EUR'],2);
                                                                        }
                                                                        if ($good->discount != 0) {
                                                                        $discount = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'" class="label discount"><span class="flash animated">'.$good->discount.'%</span></a>';
                                                                        $old_price = round($price);
                                                                        $price = round($price - $price/100*$good->discount);
                                                                        } else {
                                                                        $discount = '';
                                                                        $old_price = '';
                                                                        }
                                                                        if ($good->hit != 0) {
                                                                        $hit = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'" class="label hit"><span><i class="fa fa-star-o" aria-hidden="true"></i></span></a>';
                                                                        } else {
                                                                        $hit = '';
                                                                        }

                                                                        if(strpos($price, '.')) {
                                                                        if(substr($price, -3, 1) != '.') {
                                                                                $price = round($price,2).'0';
                                                                        }
                                                                        }
                                                                        if(strpos($old_price, '.')) {
                                                                        if(substr($old_price, -3, 1) != '.') {
                                                                                $old_price = round($old_price,2).'0';
                                                                        }
                                                                        }
                                                                        if(!strpos($price, '.')) {
                                                                        $price = $price.'.00';
                                                                        }
                                                                        if(!strpos($old_price, '.') && $old_price != '') {
                                                                        $old_price = $old_price.'.00';
                                                                        }

                                                                        echo '<div class="goods-list-block" data-page-number="'.$pageNumber.'">'
                                                                        .'<div class="row">'
                                                                        .'<div class="col-md-4 col-lg-3">'
                                                                        .'<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'"><img src="images/goods/'.$good->photo1.'" alt="" class="img-responsive"></a>'
                                                                        .$hit
                                                                        .$discount
                                                                        .'</div>  <!-- end col -->'
                                                                        .'<div class="col-md-8 col-lg-9">'
                                                                        .'<h3>'.Html::a($good->name, [Yii::$app->urlManager->createUrl('../view?id='.$good->id)], ['class' => 'goods-more']).'</h3>'
                                                                        .'<div class="row">'
                                                                        .'<i class="goods-price col-md-6"><s>'.$old_price.'</s> <span>'.$price.'</span> &#8381;</i>'
                                                                        .'<button class="goods-buy buy-from-catalog-view col-md-5"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>'
                                                                        .'<p class="col-xs-12">'
                                                                        .'<a class="preview" role="button" data-toggle="collapse" href="#collapse-more-'.$good->id.'" aria-expanded="false" aria-controls="collapse-more-'.$good->id.'">'
                                                                        .$good->description
                                                                        .'<i class="fa fa-chevron-down" aria-hidden="true"></i>'
                                                                        .'</a>'
                                                                        .'</p>'
                                                                        .'</div>'
                                                                        .'<div class="collapse" id="collapse-more-'.$good->id.'">'
                                                                        .'<div class="well">'
                                                                        .$good->text
                                                                        .'</div>  <!-- end well -->'
                                                                        .'</div>  <!-- end collapse -->'
                                                                        .'<a class="preview"  role="button" data-toggle="collapse" href="#collapse-options-'.$good->id.'" aria-expanded="false" aria-controls="collapse-options-'.$good->id.'">Характеристики'
                                                                        .'<i class="fa fa-chevron-down" aria-hidden="true"></i>'
                                                                        .'</a>'
                                                                        .'<div class="collapse" id="collapse-options-'.$good->id.'">'
                                                                        .'<div class="well">'
                                                                        .'<div class="catalog-view-props-table">'.$good->properties.'</div>'
                                                                        .'</div> <!-- end well -->'
                                                                        .'</div>  <!-- end collapse -->'
                                                                        .Html::a('Подробнее...', ['view?id='.$good->id], ['class' => 'goods-more'])
                                                                        .'</div>  <!-- end col -->'
                                                                        .'</div>  <!-- end row -->'
                                                                        .'</div>  <!-- end goods-list-block -->';
                                                                endforeach;
                                                                ?>
                                                        
                                                        </div>	<!-- end row -->

                                                </div>	<!-- end goods-container -->
                                                
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>