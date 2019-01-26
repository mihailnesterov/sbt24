<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use app\models\Company;
use app\models\Category;
use app\models\Tovar;
use app\models\Clients;
use app\models\Order;
use app\models\OrderItems;
use app\models\Banners;
use app\modules\admin\models\Users;
use app\modules\admin\models\Login;
use app\modules\admin\models\Signup;
use yii\data\Pagination;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
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
                    //'logout' => ['post'],
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
            /*'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }
    
    
    public function getCompany()
    {
        $company = Company::find()->where(['status' => '1'])->one();
        return $this->view->params['company'] = $company;
    }
    
    public function getUserIdentity()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        } else {
            $login = Yii::$app->user->identity->login;
            $params = [
                    'login' => $login
                ];
        return $params;
        }
        
    }
    
    public function getCurrencies() {
        //$xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        if (file_exists('http://cbr.ru/scripts/XML_daily.asp')) {
            $xml = simplexml_load_file('http://cbr.ru/scripts/XML_daily.asp');
        } else {
            $xml = simplexml_load_file('../web/plugins/XML_daily.asp');
        }
        
        $currencies = array();
        foreach ($xml->xpath('//Valute') as $valute) {
            $currencies[(string)$valute->CharCode] = (float)str_replace(',', '.', $valute->Value);
        }
        return $currencies;
    }
    public function getYandexMetrika()
    {
        $metrika = '<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter51001274 = new Ya.Metrika2({ id:51001274, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/51001274" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->';
        return $this->view->params['metrika'] = $metrika;
    }
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
         if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        
        $this->view->title = 'Кабинет';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $clientCount = Clients::find()->count();
        $orderCount = Order::find()->where((['status' => 1]))->count();
        $tovarCount = Tovar::find()->count();
        
        return $this->render('index', [
            'clientCount' => $clientCount,
            'orderCount' => $orderCount,
            'tovarCount' => $tovarCount
        ]);
    }
    
    /**
     * Renders the goods view for the module
     * @return string
     */
    public function actionGoods()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        $this->view->title = 'Товары';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $query = Tovar::find()->orderby(['created'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);
        $pages->pageSizeParam = false;
        $tovar = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('goods', [
            'tovar' => $tovar,
            'pages' => $pages,
        ]);
    }
    
    /**
     * Renders the categories view for the module
     * @return string
     */
    public function actionCategories()
    {
         if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        
        $this->view->title = 'Категории товаров';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        $model = Category::find()->where(['parent' => 0])->all();
        return $this->render('categories', [
            'model' => $model,
        ]);
    }
    
    /**
     * Renders the orders view for the module
     * @return string
     */
    public function actionOrders()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        
        $this->view->title = 'Заказы';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $query = Order::find()->groupby(['status'])->orderby(['created'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);
        $pages->pageSizeParam = false;
        $orders = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('orders', [
            'orders' => $orders,
            'pages' => $pages,
        ]);
    }
    
    /**
     * Renders the clients view for the module
     * @return string
     */
    public function actionClients()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        $this->view->title = 'Клиенты';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $query = Clients::find()->where(['>','id',1])->orderby(['created'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 20]);
        $pages->pageSizeParam = false;
        $clients = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('clients', [
            'clients' => $clients,
            'pages' => $pages,
        ]);
    }
    
    /**
     * Renders the banners view for the module
     * @return string
     */
    public function actionBanners()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }

        $banners = Banners::find()->orderby(['created'=>SORT_ASC])->all();

        $this->view->title = 'Баннеры';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('banners', [
            'banners' => $banners,
        ]);
    }

    /**
     * Renders the banner id view for the module
     * @return string
     */
    public function actionBannerView($id)
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }

        $model = $this->findBannerModel($id);

        $this->view->title = $model->name;
        $this->view->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => '@web/admin/banners'];
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        return $this->render('banner-view', [
            'model' => $model,
        ]);
    }

    protected function findBannerModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Renders the company view for the module
     * @return string
     */
    public function actionCompany()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        $this->view->title = 'Компания';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $company = Company::find()->where((['status' => 1]))->one();
        
        if ($company->load(Yii::$app->request->post())) {

            if ($company->save()) {    
                //header("Refresh: 0");
                Yii::$app->view->registerJs(
                "
                    $.gritter.add({
                            title: 'Информация о компании:',
                            text: 'Изменения сохранены',
                            image: '".Yii::$app->homeUrl."images/image.png',
                            sticky: false,
                            time: '3000'
                        });
                    "
                );
            }
        }
        
        return $this->render('company', [
            'company' => $company
        ]);
    }
    
    /**
     * Renders the settings view for the module
     * @return string
     */
    public function actionSettings()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        $this->view->title = 'Настройки';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('settings');
    }
    
    /**
     * Renders the profile view for the module
     * @return string
     */
    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) 
        {
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
        }
        $this->view->title = 'Мой профиль ( '.Yii::$app->user->identity->login.' )';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        $user = Users::find()->where((['id' => Yii::$app->user->identity->id]))->one();
        
        if ($user->load(Yii::$app->request->post())) {

            if ($user->save()) {    
                Yii::$app->view->registerJs(
                "
                    $.gritter.add({
                            title: 'Пользователь ".$user->login.":',
                            text: 'Изменения сохранены',
                            image: '".Yii::$app->homeUrl."images/image.png',
                            sticky: false,
                            time: '3000'
                        });
                    "
                );
            }
        }
        
        return $this->render('profile', [
            'user' => $user
        ]);
    }
    
    /**
     * Renders the login view for the module
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) 
        {
            //return $this->goHome();
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin'));
        }
        
        $this->view->title = 'Войти в кабинет';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        
        $model = new Login();

        if ($model->load(Yii::$app->request->post()) 
            && $model->login()) 
        {
            
            Yii::$app->view->registerJs(
            "
                $.gritter.add({
                    title: '".$model->login.",',
                    text: 'Добро пожаловать в кабинет!',
                    image: '".Yii::$app->homeUrl."images/logo.png',
                    sticky: 'false',
                    time: '5000'
                });
            "
            );
            
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin'));
        }
        
        $this->layout = 'login';

        return $this->render('login', [
            'model' => $model,
        ]);
    }
    
    /**
     * Signup user.
     * @return mixed
     */
    public function actionSignup()
    {
   
        /*if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }*/
        
        $model = new Signup();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new Users();
            $user->login = $model->login;
            $user->email = $model->email;
            $user->setPassword($model->password);
            //$user->auth_key = \Yii::$app->security->generateRandomKey($lenght = 255);
            $user->auth_key = \Yii::$app->security->generateRandomString($lenght = 255);

            //echo '<pre>'; print_r($user); die;
            if ($user->save()) {
                
                // create user images directory in web/images/users/
                /*$user_img_dir_path = \Yii::$app->basePath.'/web/images/users/'.$user->login;
                FileHelper::createDirectory($user_img_dir_path, $mode = 0775, $recursive = false);*/
                
                // send registration info on user email
                Yii::$app->mailer->compose([
                'html' => 'test',
                'text' => 'test',
                ])
                ->setFrom(['myzgr@mail.ru' => 'Письмо с сайта sbt24.ru'])
                ->setTo($user->email)
                ->setSubject('Вы успешно зарегистрировались в личном кабинете sbt24.ru')
                ->setTextBody('Ваш логин: '.$model->login.', ваш пароль: '.$model->password)
                ->setHtmlBody('<p>Ваш логин: <b>'.$model->login.'</b>,<br> ваш пароль: <b>'.$model->password.'</b></p><p>Войти в личный кабинет: <a href="http://sbt24.ru/admin" target="_blank">sbt24.ru/admin</a></p>')
                ->send();
                
                $user->login();
                
                return $this->redirect(['/admin']);
               
            } 
        }
        
        $this->layout = 'login';
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    /*
     * Logout user method
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        //return $this->goHome();
        return $this->redirect(Yii::$app->urlManager->createUrl('/admin/login'));
    }
}
