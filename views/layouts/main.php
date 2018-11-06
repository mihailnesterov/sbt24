<?php
    use yii\helpers\Html;
    use app\assets\AppAsset;
    
    $directoryAsset = Yii::$app->assetManager->getPublishedUrl(Yii::$app->homeUrl.'web');   
    $metrika = Yii::$app->controller->getYandexMetrika('metrika');
    
    $currencies = Yii::$app->controller->getCurrencies();
    
    $this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        
        <meta property="og:type" content="website" />
        <meta property="og:url" content="<?= Yii::$app->homeUrl ?>" />
        <meta property="og:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="<?= Yii::$app->homeUrl ?>images/logo.png" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="<?= $this->title ?> | <?= Yii::$app->name ?>" />
        <meta name="twitter:image:src" content="<?= Yii::$app->homeUrl ?>images/logo.png" />
        <meta name="twitter:description" content="" />
        <link rel="image_src" href="<?= Yii::$app->homeUrl ?>images/logo.png" />

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
                                            <div id="schedule-block" class="col-md-4 text-center">
                                                    <p>Курс USD = <?= $currencies['USD'] ?></p>
                                                    <p>Курс EUR = <?= $currencies['EUR'] ?></p>
                                            </div>
                                            <div id="top-phone-block" class="col-md-3">
                                                    <p id="top-phone" class="text-left"><i class="fa fa-phone" aria-hidden="true"></i><?= Yii::$app->controller->getCompany('company')->phone1 ?></p>
                                                    <p id="top-user" class="text-left">
                                                            <i class="fa fa-user-o" aria-hidden="true"></i><a href="#">userlogin</a>
                                                            / 
                                                            <a href="#">Выйти</a>
                                                    </p>
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
                                            <div id="cart" class="col-sm-2 text-right">
                                                    <a href="#">
                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                            <span id="cart-price">0.00</span>
                                                            <i class="fa fa-rub" aria-hidden="true"></i>
                                                            <span id="cart-quantity">0</span>
                                                    </a>
                                            </div>
                                    </nav>	<!-- end nav -->
                            </div> <!-- end container -->
                    </div>	 <!-- end container-fluid -->
            </header>
            
            <?= $content ?>
            
            <footer class="container-fluid">
                    <div class="container">
                            1232
                            <div class="row">
                                    <p id="copyright" class="col-12 text-center"> <?= date('Y') ?> &copy <?= Html::a(Yii::$app->controller->getCompany('company')->name.' | Интернет-магазин', ['/']) ?> <?= Yii::$app->controller->getCompany('company')->phone1 ?> Красноярск</p>
                            </div>
                    </div>
            </footer>
        </div> 	<!-- end wrapper-->
         
        
        <div id="toTop"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
        <script>ActiveLinksMain('main-menu')</script>
        <?= $metrika ?>
        <?php $this->endBody(); ?>
    </body>
</html>
<?php $this->endPage(); ?>
