<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\Company;
use app\models\Category;
use app\models\Tovar;
use app\modules\admin\models\Login;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function getCompany()
    {
        $company = Company::find()->where(['status' => '1'])->one();
        return $this->view->params['company'] = $company;
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
        $this->view->title = 'Кабинет';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('index');
    }
    
    /**
     * Renders the goods view for the module
     * @return string
     */
    public function actionGoods()
    {
        $this->view->title = 'Каталог товаров';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('goods');
    }
    
    /**
     * Renders the categories view for the module
     * @return string
     */
    public function actionCategories()
    {
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
        $this->view->title = 'Заказы';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('orders');
    }
    
    /**
     * Renders the users view for the module
     * @return string
     */
    public function actionUsers()
    {
        $this->view->title = 'Пользователи';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('users');
    }
    
    /**
     * Renders the company view for the module
     * @return string
     */
    public function actionCompany()
    {
        $this->view->title = 'Компания';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('company');
    }
    
    /**
     * Renders the settings view for the module
     * @return string
     */
    public function actionSettings()
    {
        $this->view->title = 'Настройки';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        return $this->render('settings');
    }
    
    /**
     * Renders the login view for the module
     * @return string
     */
    public function actionLogin()
    {
        $this->view->title = 'Войти в кабинет';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        if (!Yii::$app->user->isGuest) 
        {
            //return $this->goHome();
            return $this->redirect(Yii::$app->urlManager->createUrl('/admin'));
        }
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
