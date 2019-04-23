<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$this->title = 'Заказ № sbt24-'.$this->params['order_id'].' от '.$this->params['order_date'];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        body {
            background-color: #eee;
            font-family: Helvetica, Verdana, Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.6;
        }
        h1,h2,h3,h4 {
            color: #222;
            /*text-transform: uppercase;*/
        }
        #wrapper {
            background-color: #fff;
            margin: 0 auto;
            max-width: 800px;
        }
        #header, #footer {
            background-color: #333;
            color: #fff;
            padding: 15px 25px;
        }
        #header {
            padding-left: 40px;
        }
        #site-name {
            display: inline-block;
            vertical-align: middle;
            width: 50%;
        }
        #site-name h3 {
            font-size: 1.4em;
            font-weight: 600;
            color: #5BE112;
        }
        #top-contacts {
            display: inline-block;
            vertical-align: middle;
            width: 46%;
            text-align: right;
        }
        #top-contacts h3 {
            font-size: 1.4em;
            color: #5BE112;
        }
        #header a {
            color: #5BE112;
        }
        #content {
            margin: 0;
            padding: 15px 40px;
            border: 1px #eee solid;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            
        }
        table th {
            background-color: #eee;
            padding: 10px 20px;
            border: 1px #ddd solid;
        }
        table td {
            padding: 10px 20px;
            border: 1px #ddd solid;
            text-align: center;
        }
        #footer h3 {
            font-size: 1.4em;
            color: #5BE112;
            text-align: center;
        }
        #footer a {
            color: #5BE112;
            text-decoration: none;
        }
        .text-center {
            text-align: center !important;
        }
        .text-left {
            text-align: left !important;
        }
        .text-right {
            text-align: right !important;
        }
        #pdf {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            margin-bottom: 30px;
            background-color: rgb(204, 51, 45);
            color: #fff;
            text-decoration: none;
        }
        #pdf:hover {
            text-decoration: underline;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <?php $this->beginBody() ?>

    <div id="wrapper">
        <div id="header">
            <div id="site-name">
                <h3><?= $this->params['company']->name ?></h3>
            </div>
            <div id="top-contacts">
                <h3><?= $this->params['company']->phone1 ?></h3>
                <a href="mailto:<?= $this->params['company']->email ?>"><?= $this->params['company']->email ?></a>
            </div>
        </div>
        <div id="content">
            <?= $content ?>
        </div>

        <div id="footer">
            <p class="text-center">Интернет-магазин <a href="http://sbt24.ru" target="_blank">sbt24.ru</a></p>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>