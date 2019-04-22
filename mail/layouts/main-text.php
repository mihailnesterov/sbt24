<?php

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

?>
Здравствуйте, <?= $this->params['client_contact'] ?> ваш id = <?= $this->params['client_id'] ?>
Company: <?= $this->params['company']->name ?>
<?= $content ?>