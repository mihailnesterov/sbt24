<?php

/*
 * service page
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
                                    
                                    <div class="banner-block">
                                        <a href="#"><img src="images/category-banner-889x200.jpg" alt="" class="img-responsive"></a>
                                    </div>  <!-- end banner-block -->
                                    
                                    <div class="filter-block btn-toolbar" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i> Новинки</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-star-o" aria-hidden="true"></i> Популярные</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Скидки</button>
                                        
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-fa" aria-hidden="true"></i> Бренды
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">DoCash </a></li>
                                                <li><a href="#">Doors</a></li>
                                                <li><a href="#">GLORY</a></li>
                                                <li><a href="#">SBM</a></li>
                                            </ul>
                                        </div>
                                    </div>  <!-- end filter-block -->

                                        <div class="content-block">
                                            <header>
                                                <h1><?= Html::encode($this->title) ?></h1>
                                            </header>
                                            
                                            <div class="goods-container">	
                                                        <div class="row">
                                                            
                                                            <?php
                                                                // вывод каталога из БД

                                                                foreach ($model as $cat):
                                                                    echo '<div class="col-sm-12 col-lg-4">'
                                                                        . '<div class="goods-block">'
                                                                        . '<div class="goods-block-fg">'.'<a href="'.Yii::$app->urlManager->createUrl('catalog/'.$cat->id).'"></a></div>'
                                                                        . '<a href="'.Yii::$app->urlManager->createUrl('catalog/'.$cat->id).'"><img src="images/tovar1.jpg" alt="'.$cat->name.'" class="img-responsive"></a>'
                                                                        . '<hr>'
                                                                        //. '<hr><p><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></p>'
                                                                        . '<h4>'.$cat->name.'</h4>'
                                                                        . Html::a('Подробнее', ['catalog/'.$cat->id], ['class' => 'goods-more'])
                                                                        . '</div>    <!-- end goods-block -->'
                                                                        . '</div>    <!-- end col -->';
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