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

                                        <div class="content-block">
                                                <header>
                                                    <h1><?= Html::encode($this->title) ?></h1>
                                                </header>
                                            
                                                <ul class="company-contacts">
                                                    <li><i class="fa fa-address-card" aria-hidden="true"></i> <?= Yii::$app->controller->getCompany('company')->company_name ?></li>
                                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?= Yii::$app->controller->getCompany('company')->address ?></li>
                                                    <li><i class="fa fa-phone" aria-hidden="true"></i> <?= Yii::$app->controller->getCompany('company')->phone1 ?></li>
                                                    <li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?= Yii::$app->controller->getCompany('company')->email ?>"><?= Yii::$app->controller->getCompany('company')->email ?></a></li>
                                                </ul>

                                                <div class="company-map">
                                                    <?= Yii::$app->controller->getCompany('company')->map ?>
                                                </div>

                                                <?php foreach ($bannersPos10 as $key => $banner): ?>
                                                        <div class="banner-block">
                                                                <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
                                                        </div><!-- end banner-block -->
                                                <?php endforeach ?>
                                                
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>