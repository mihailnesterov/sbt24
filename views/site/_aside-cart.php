<?php

/* 
 * aside для корзины, профиля и страницы заказов пользователя
 */

use yii\helpers\Html;

// получаем структуру каталога
$category = Yii::$app->controller->getCatalog('category');
// получаем данные о клиенте
$client = Yii::$app->controller->getClient();
// получаем данные о заказе
$order = Yii::$app->controller->getOrderFromCookie();

mb_internal_encoding('UTF-8');
?>
<aside class="col-sm-5 col-md-4">
    
    <div class="aside-block">
        <nav id="client-menu" class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <h3><i class="fa fa-user-o"></i> 
                    <?php if ( $client['client']->company != ''): ?>
                        <?= $client['client']->company ?>
                    <?php else: ?>
                        Гость
                    <?php endif ?>
                </h3>
                <?php if (Yii::$app->request->cookies->has('sbt24order')): ?>
                <li><?= Html::a('<i class="fa fa-shopping-cart"></i> Моя корзина ( '. $order['orderItemsCount'] .' )', Yii::$app->urlManager->createUrl(['cart'])) ?></li>
                <?php else: ?>
                <li><?= Html::a('<i class="fa fa-shopping-cart"></i> Моя корзина ( 0 )', Yii::$app->urlManager->createUrl(['cart'])) ?></li>
                <?php endif ?>
                <li><?= Html::a('<i class="fa fa-list-ol"></i> Мои заказы ( '. Yii::$app->controller->getMyOrdersCount() .' )', Yii::$app->urlManager->createUrl(['orders'])) ?></li>
                <li><?= Html::a('<i class="fa fa-user-o"></i> Мой профиль', Yii::$app->urlManager->createUrl(['profile'])) ?></li>
            </ul>
       </nav>
    </div>
    
    <div class="aside-block default">
        <nav id="catalog-menu" class="navbar navbar-default">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="<?= Yii::$app->urlManager->createUrl(['/']) ?>"><?= Yii::$app->name ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Каталог товаров</h3>
                    <li>
                        <form id="search" method="GET" action="<?= Yii::$app->urlManager->createUrl(['search']) ?>" class="form-inline">
                            <div class="input-group col-xs-12">
                                <input id="q" name="q" class="form-control" type="text" placeholder="Поиск по каталогу..." aria-label="Поиск...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <hr>
                    </li>
                    
                    <?php // вывод меню ?>
                    <?php foreach ($category as $key => $cat): ?>
                        <?php $sub_category = \app\models\Category::find()->where(['parent' => $cat->id])->all(); ?>
                        <?php if ( $sub_category == NULL): ?>
                            <?php $tovar_count = \app\models\Tovar::find()->where(['category_id' => $cat->id])->count(); ?>
                                <?php if ( $tovar_count != 0): ?>
                                    <li>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]) ?>"><i class="fa fa-arrow-right"></i><?= $cat->name ?></a>
                                    </li>
                                <?php endif ?>
                        <?php else : ?>
                            <li role="presentation" class="dropdown">
                                <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->id]) ?>" data-target="<?= Yii::$app->urlManager->createUrl(['catalog/'.$cat->link]) ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-right"></i><?= $cat->name ?>  <i class="fa fa-caret-right"></i></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($sub_category as $key => $sub_cat): ?>
                                        <?php $tovar_count = \app\models\Tovar::find()->where(['category_id' => $sub_cat->id])->count(); ?>
                                        <?php if ( $tovar_count != 0): ?>
                                            <li class="category-menu-item text-center col-xs-12 col-md-6">
                                                <img src="images/catalog/<?= $sub_cat->image ?>" alt="<?= $sub_cat->name ?>">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['catalog/'.$sub_cat->id]) ?>"><?= $sub_cat->name ?> (<?= $tovar_count ?>)</a>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>    
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                            
                    <div class="visible-xs">
                        <hr>
                        <ul class="nav navbar-nav">
                            <li><a href="<?= Yii::$app->urlManager->createUrl('/') ?>"><i class="fa fa-arrow-right"></i>Главная</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('catalog') ?>"><i class="fa fa-arrow-right"></i>Каталог</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('services') ?>"><i class="fa fa-arrow-right"></i>Услуги</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('dostavka') ?>"><i class="fa fa-arrow-right"></i>Доставка</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('payment') ?>"><i class="fa fa-arrow-right"></i>Оплата</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('about') ?>"><i class="fa fa-arrow-right"></i>О компании</a></li>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('contacts') ?>"><i class="fa fa-arrow-right"></i>Контакты</a></li>
                        </ul>
                    </div>
                </ul>   <!-- nav navbar-nav -->
            </div>  <!-- end #navbar -->
        </nav>  <!-- end catalog-menu -->
    </div>  <!-- end aside-block -->

    

</aside><!-- end aside -->