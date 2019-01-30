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
                                                    <h1>
                                                        <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin', ['class' => 'go-back-link', 'title' => 'Кабинет']) ?>
                                                        <?= Html::encode($this->title) ?>
                                                    </h1>
                                                    <p class="bg-warning">Добавление, редактирование, удаление категорий. Нельзя удалить непустую категорию. Сначала удалите или перенесите из нее товары в другие категории.</p>
                                                </header>

                                                <div class="goods-container">	
                                                    <div class="admin-categories-list">    
                                                        <ul class="category-level-0">
                                                        <?php foreach ($model as $key => $cat): 
                                                            $count = $cat->getSubTovarCount($cat->id);
                                                            $subcategory = $cat->getSubcategory($cat->id);
                                                        ?>
                                                            <?php if($subcategory): ?>
                                                            <li>
                                                                <span class="name-block text-left">
                                                                    <i class="fa fa-folder"></i>
                                                                    <a href="#"><?= $cat->name ?> (<?= $count ?>)</a>
                                                                </span>
                                                                <span class="i-block text-right">
                                                                    <i class="fa fa-close hidden" title="Удалить"></i> 
                                                                    <i class="fa fa-pencil" title="Редактировать"></i>
                                                                </span>
                                                            </li>
                                                                <ul class="category-level-1">
                                                                    <?php foreach ($subcategory as $key => $sub): 
                                                                        $count = $cat->getTovarCount($sub->id);
                                                                    ?>
                                                                        <?php if($count == 0): ?>
                                                                            <li>
                                                                                <span class="name-block text-left">
                                                                                    <i class="fa fa-folder-o" title="Пустая категория"></i>
                                                                                    <?= $sub->name ?> (<?= $count ?>) 
                                                                                </span>
                                                                                <span class="i-block text-right">
                                                                                    <i class="fa fa-close" title="Удалить"></i>
                                                                                    <i class="fa fa-pencil" title="Редактировать"></i>
                                                                                </span>
                                                                            </li>
                                                                        <?php else: ?>
                                                                            <li>
                                                                                <span class="name-block text-left">
                                                                                    <i class="fa fa-folder" title="Непустая категория"></i>
                                                                                    <?= $sub->name ?> (<?= $count ?>) 
                                                                                </span>
                                                                                <span class="i-block text-right">
                                                                                    <i class="fa fa-close hidden" title="Удалить"></i> 
                                                                                    <i class="fa fa-pencil" title="Редактировать"></i>
                                                                                </span>
                                                                            </li>
                                                                        <?php endif; ?>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php else: ?>
                                                                <li>
                                                                    <span class="name-block text-left">
                                                                        <i class="fa fa-folder-o"></i>
                                                                        <?= $cat->name ?> (<?= $count ?>) 
                                                                    </span>
                                                                    <span class="i-block text-right">
                                                                        
                                                                        <i class="fa fa-close" title="Удалить"></i> 
                                                                        <i class="fa fa-pencil" title="Редактировать"></i>
                                                                    </span>
                                                                </li>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                            <?php
                                                            // вывод каталога из БД
                                                            /*foreach ($model as $cat):
                                                                $count = $cat->getTovarCount($cat->id);
                                                                $subcategory = $cat->getSubcategory($cat->id);
                                                                if($subcategory) {
                                                                    echo '<li class="row"><a href="#" class="text-left col-xs-9">'. $cat->name.' ('.$count.')</a> <span class="btn-block text-right col-xs-3"><i class="fa fa-close hidden" title="Удалить"></i> <i class="fa fa-pencil-square" title="Редактировать"></i></span></li>';
                                                                    echo '<ul class="category-level-1">';
                                                                        foreach ($subcategory as $sub):
                                                                            $count = $cat->getTovarCount($sub->id);
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
                                                            endforeach;*/
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