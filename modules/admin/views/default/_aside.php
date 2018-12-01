<aside class="col-sm-5 col-md-4">
    <div class="aside-block default">
        <nav id="catalog-menu" class="navbar navbar-default">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs" href="<?= Yii::$app->urlManager->createUrl('/admin') ?>">sbt24.ru ( кабинет )</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <h3><i class="fa fa-bars" aria-hidden="true"></i>Меню</h3>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/goods') ?>"><i class="fa fa-shopping-cart"></i>Каталог товаров</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/categories') ?>"><i class="fa fa-folder-open-o"></i>Категории товаров</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/orders') ?>"><i class="fa fa-rub"></i>Заказы</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/users') ?>"><i class="fa fa-user-o"></i>Пользователи</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/company') ?>"><i class="fa fa-building-o"></i>Компания</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/admin/settings') ?>"><i class="fa fa-gears"></i>Настройки</a></li>
                    <li><hr></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('/') ?>"><i class="fa fa-link"></i>Перейти на сайт</a></li>
                    <li><a href="<?= Yii::$app->urlManager->createUrl('logout') ?>"><i class="fa fa-sign-out"></i>Выйти</a></li>
                </ul>   <!-- nav navbar-nav -->
            </div>  <!-- end #navbar -->
        </nav>  <!-- end catalog-menu -->
    </div>  <!-- end aside-block -->


</aside><!-- end aside -->