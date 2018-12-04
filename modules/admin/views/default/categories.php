<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
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

        <div id="page-container1" class="container">

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
                                                    <div class="admin-categories-list">    
                                                        <ul class="category-level-0">
                                                            <?php
                                                            // вывод каталога из БД
                                                            foreach ($model as $cat):
                                                                $count = \app\models\Tovar::find()->where(['category_id' => $cat->id])->count();
                                                                $subcategory = \app\models\Category::find()->where(['parent' => $cat->id])->all();
                                                                
                                                                if($subcategory) {
                                                                    echo '<li>'. $cat->name.' ('.$count.') <i class="fa fa-close hidden" title="Удалить"></i> <i class="fa fa-pencil-square" title="Редактировать"></i></li>';
                                                                    echo '<ul class="category-level-1">';
                                                                        foreach ($subcategory as $sub):
                                                                            $count = \app\models\Tovar::find()->where(['category_id' => $sub->id])->count();
                                                                            if($count == 0) {
                                                                                echo '<li>'. $sub->name.' ('.$count.') <i class="fa fa-close" title="Удалить"></i> <i class="fa fa-pencil-square" title="Редактировать"></i></li>';
                                                                            } else {
                                                                                echo '<li>'. $sub->name.' ('.$count.') <i class="fa fa-close hidden" title="Удалить"></i> <i class="fa fa-pencil-square" title="Редактировать"></i></li>';
                                                                            }
                                                                        endforeach;
                                                                    echo '</ul>';
                                                                } else {
                                                                    echo '<li>'. $cat->name.' ('.$count.') <i class="fa fa-close" title="Удалить"></i> <i class="fa fa-pencil-square" title="Редактировать"></i></li>';
                                                                }
                                                            endforeach;
                                                            ?>
                                                        </ul>
                                                    </div>	<!-- end admin-categories-list -->
                                                </div>	<!-- end goods-container -->
                                        </div>	<!-- end content-block -->

                                        

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>