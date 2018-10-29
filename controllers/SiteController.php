<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->view->title = Yii::$app->name;
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => '',
            'content' => ''
        ]);

        echo Yii::$app->name;
        return $this->render('index');
    }
}
