<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;

class SiteController extends Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex()
    {
        $this->view->title = 'Главная';
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('index');
    }
    
    public function actionServices()
    {
        $this->view->title = 'Наши услуги';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('services');
    }
    
    public function actionDostavka()
    {
        $this->view->title = 'Доставка';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('dostavka');
    }
    
    public function actionPayment()
    {
        $this->view->title = 'Оплата';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('payment');
    }
    
    public function actionAbout()
    {
        $this->view->title = 'О компании';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('about');
    }
    
    public function actionContacts()
    {
        $this->view->title = 'Контакты';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);

        return $this->render('contacts');
    }
    
    /*
     * Error page (404...)
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception != null) {
            if ($exception instanceof HttpException) {
                return $this->redirect(['404/'])->send();
            }
        }
        return $this->render('error',['exception' => $exception]);
    }
    
    /*
     * 404 page
     */
    /*public function actionNotFound()
    {
        return $this->render('404');
    }*/
}
