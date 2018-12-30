<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
?>
<br>
<div class="site-login container" style="margin: 0 auto; max-width: 480px;">
    <div id="content-container">
        <div class="content-block" style="padding: 2em;">
            <header>
                    <h1><?= Html::encode($this->title) ?></h1>
            </header>

            <div class="goods-container" style="padding: 2em;">	
                    <div class="row">

                    <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'login', [
                            'template' => '{input}{error}',
                            'inputOptions' => [
                                'autofocus' => 'autofocus',
                                'tabindex' => '1',
                                'placeholder' => 'Логин',
                                'class'=>'form-control input-lg',
                                //'pattern'=>'\D+([a-zA-Z0-9._@])$'
                            ]
                        ])->textInput(['maxlength' => true])->label(false) ?>


                        <?= $form->field($model, 'email', [
                            'template' => '{input}{error}',
                            'inputOptions' => [
                                'tabindex' => '2',
                                'placeholder' => 'Email',
                                'class'=>'form-control input-lg',
                            ]
                        ])->textInput(['maxlength' => true])->label(false) ?>


                        <?= $form->field($model, 'password', [
                            'template' => '{input}{error}',
                            'inputOptions' => [
                                'tabindex' => '3',
                                'placeholder' => 'Пароль',
                                'class'=>'form-control input-lg'
                            ]
                        ])->passwordInput(['maxlength' => true])->label(false) ?>
    
        <div class="form-group text-center">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-lg btn-orange btn-login', 'style' => 'display: block; min-width: 50%; margin: 1.5em auto;']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    
    <div class="login-links text-center">
        У меня уже есть аккаунт <a href="<?=Yii::$app->urlManager->createUrl(['/admin/login'])?>" >Войти</a>
    </div>

    <!--<div class="login-links text-center">
        <a href="<?=Yii::$app->urlManager->createUrl(['/admin/password-restore'])?>" >Забыли пароль?</a>
    </div>-->

</div><!-- site-login -->
