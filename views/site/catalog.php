<?php

/*
 * catalog page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid hidden-xs">
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

                                    <?php foreach ($bannersPos3 as $key => $banner): ?>
                                        <div class="banner-block">
                                            <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
                                        </div><!-- end banner-block -->
                                    <?php endforeach ?>

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
                                                                . '<a href="'.Yii::$app->urlManager->createUrl('catalog/'.$cat->id).'"><img src="images/catalog/'.$cat->image.'" alt="'.$cat->name.'" class="img-responsive"></a>'
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