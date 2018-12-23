<?php
    use yii\helpers\Html;
    use app\assets\AppAsset;
    use yii\widgets\Pjax;
    
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->homeUrl.'web');   
    $metrika = Yii::$app->controller->getYandexMetrika('metrika');
    
    $currencies = Yii::$app->controller->getCurrencies();

    $order = Yii::$app->controller->getOrderFromCookie();
    
    $this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?= Yii::$app->request->url ?>" />
        <meta property="og:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta property="og:description" content="<?= $this->title ?>" />
        <meta property="og:image" content="<?= Yii::$app->homeUrl ?>web/images/logo.png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta name="twitter:image:src" content="<?= Yii::$app->homeUrl ?>web/images/logo.png" />
        <meta name="twitter:description" content="<?= $this->title ?>" />
        <link rel="image_src" href="<?= Yii::$app->homeUrl ?>web/images/image.png" />

        <base href="<?= Yii::$app->homeUrl ?>">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?> | <?= Html::encode(Yii::$app->name) ?></title>
        
        <?php $this->head(); ?>
        
        <!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => $directoryAsset . 'favicon.ico']) ?>
        
        <?php            
            AppAsset::register($this);
        ?>
        
    </head>
    <body>
        <?php $this->beginBody(); ?>
        
        <div id="wrapper">
            <header id="header">
                <div id="top" class="container-fluid">
                        <div class="container">
                                <div class="row">
                                        <div id="logo-block" class="col-md-5">
                                                <div class="row">
                                                        <div id="logo" class="col-sm-3">
                                                                <a href="<?= Yii::$app->urlManager->createUrl('/') ?>"><img src="images/image.png" alt="logo" class="img-responsive"></a>
                                                        </div>
                                                        <div class="col-sm-9">
                                                                <p id="site-name"><a href="/"><?= Yii::$app->controller->getCompany('company')->name ?></a></p>
                                                                <p id="slogan"><?= Yii::$app->controller->getCompany('company')->description ?></p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div id="schedule-block" class="col-md-4 text-left">
                                            <p>USD = <?= $currencies['USD'] ?></p>
                                            <p>EUR = <?= $currencies['EUR'] ?></p>
                                            <p>
                                                <?php
                                                    //if(Yii::$app->request->cookies->has('sbt24client'))
                                                    //echo 'Client = '.Yii::$app->getRequest()->getCookies()->getValue('sbt24client');
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                    //if(Yii::$app->request->cookies->has('sbt24order'))
                                                    //echo 'Order = '.Yii::$app->getRequest()->getCookies()->getValue('sbt24order');
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                    //echo Yii::$app->controller->action->id;
                                                ?>
                                            </p>
                                        </div>
                                        <div id="top-phone-block" class="col-md-3">
                                                <p id="top-phone" class="text-left"><i class="fa fa-phone" aria-hidden="true"></i><?= Yii::$app->controller->getCompany('company')->phone1 ?></p>
                                                <div id="top-user" class="text-left">
                                                    <span class="dropdown">
                                                        <i class="fa fa-user-o"></i>
                                                        <?php 
                                                            if(Yii::$app->request->cookies->has('sbt24client')) {
                                                                $clientFromCookie = \app\models\Clients::find()->where(['id' => Yii::$app->getRequest()->getCookies()->getValue('sbt24client')])->one();
                                                                if($clientFromCookie->company === ''){
                                                                    $username = 'Гость';
                                                                } else {
                                                                     $username = $clientFromCookie->company;
                                                                }
                                                            } /*elseif ($order['client'] != null) {
                                                                $username = 'Гость';
                                                            }*/
                                                            else {
                                                                $username = 'Гость';
                                                            }
                                                        ?>
                                                        <a href="#" id="user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $username ?></a>
                                                        <ul class="dropdown-menu" aria-labelledby="user-menu">
                                                            <?php
                                                                if(Yii::$app->request->cookies->has('sbt24client')) {
                                                                    $myorders = \app\models\Order::find()->where(['client_id' => Yii::$app->getRequest()->getCookies()->getValue('sbt24client')])->andWhere(['status' => 1])->count();
                                                                    if(Yii::$app->request->cookies->has('sbt24order')) {
                                                                        echo '<li><a href="'.Yii::$app->urlManager->createUrl('cart').'"><i class="fa fa-shopping-cart"></i> Моя корзина ( '.$order['orderItemsCount'].' )</a></li>';
                                                                    } else {
                                                                        echo '<li><a><i class="fa fa-shopping-cart"></i> Корзина пуста</a></li>';
                                                                    }
                                                                    echo '<li><a href="'.Yii::$app->urlManager->createUrl('myorders').'"><i class="fa fa-list-ol"></i> Мои заказы ( '. $myorders .' )</a></li>';
                                                                    echo '<li><a href="'.Yii::$app->urlManager->createUrl('myprofile').'"><i class="fa fa-user-o"></i> Мой профиль</a></li>';
                                                                } else {
                                                                    echo '<li><a><i class="fa fa-shopping-cart"></i> Корзина пуста</a></li>';
                                                                }   
                                                            ?>
                                                            <!--<li role="separator" class="divider"></li>
                                                            <li><a href="#"><i class="fa fa-sign-out"></i> Выйти</a></li>-->
                                                        </ul>
                                                    </span>
                                                    <!--/ 
                                                    <a href="#">Корзина</a>-->
                                                </div>
                                        </div>
                                </div>	<!-- end row -->
                        </div>	<!-- end container -->
                </div>

                <div id="main-menu-container" class="container-fluid">
                    <div class="container">
                        <nav id="main-menu" class="row">
                            <ul class="col-sm-10">
                                <li><a href="<?= Yii::$app->urlManager->createUrl('/') ?>">Главная</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('catalog') ?>">Каталог</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('services') ?>">Услуги</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('dostavka') ?>">Доставка</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('payment') ?>">Оплата</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('about') ?>">О компании</a></li>
                                <li><a href="<?= Yii::$app->urlManager->createUrl('contacts') ?>">Контакты</a></li>
                            </ul>
                            <?php //Pjax::begin(); ?>
                            <div id="cart" class="col-sm-2 text-right">
                                <?php 
                                    $orderItemsSum = "0.00";
                                    $orderItemsCount = 0;
                                    $url = Yii::$app->urlManager->createUrl('cart');
                                    if($order['client'] == null){  
                                        //$url = $_SERVER['REQUEST_URI'];
                                    } elseif($order['orderItems'] == null){  
                                        //$url = $_SERVER['REQUEST_URI'];
                                    }
                                    else {
                                        $orderItemsSum = $order['orderItemsSum'];
                                        $orderItemsCount = $order['orderItemsCount'];
                                    }
                                ?>
                                <a href="<?= $url ?>" id="cart-link">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="cart-price"> <?= $orderItemsSum ?> </span>
                                    <i class="fa fa-rub" aria-hidden="true"></i>
                                    <span id="cart-quantity"><?= $orderItemsCount ?></span>
                                </a>
                            </div>      <!-- end cart -->
                            <?php //Pjax::end(); ?>
                        </nav>      <!-- end nav -->
                    </div>      <!-- end container -->
                </div>      <!-- end container-fluid -->
            </header>   <!-- end header -->
            
            <?= $content ?>
            
            <footer class="container-fluid">
                <div class="row">
                    <div class="container">
                        1232
                        <div class="row">
                                <p id="copyright" class="col-12 text-center"> <?= date('Y') ?> &copy <?= Html::a(Yii::$app->controller->getCompany('company')->name.' | Интернет-магазин', ['/']) ?> <?= Yii::$app->controller->getCompany('company')->phone1 ?> Красноярск</p>
                        </div>      <!-- end row -->
                    </div>      <!-- end container -->
                </div>      <!-- end row -->
            </footer>   <!-- end footer-->
        </div>      <!-- end wrapper-->
         
        
        <div id="toTop"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
        <!--<script>ActiveLinksMain('main-menu')</script>-->
        <?= $metrika ?>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>
