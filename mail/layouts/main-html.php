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
            background-color: #f1f1f1;
            font-family: Helvetica, Verdana, Arial, sans-serif;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.6;
        }
        h1,h2,h3,h4 {
            color: #222;
            text-transform: uppercase;
        }
        #wrapper {
            background-color: #fff;
            margin: 0 auto;
            max-width: 900px;
        }
        #header {
            background-color: #333;
            color: #fff;
            padding: 15px;
        }
        #header h3 {
            font-size: 1.4em;
            font-weight: 600;
            color: #5BE112;
        }
        #header a {
            color: #5BE112;
        }
        #content {
            margin: 15px;
            padding: 15px;
            border: 1px #c0c0c0 solid;
        }
    </style>
</head>
<body>
    <?php $this->beginBody() ?>

    <div id="wrapper">
        <div id="header">
            <h3><?= $this->params['company']->name ?></h3>
            <p>интернет-магазин <a href="http://sbt24.ru" target="_blank">sbt24.ru</a></p>

        </div>
        <div id="content">
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>