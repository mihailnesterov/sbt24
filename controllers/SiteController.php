<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Company;
use app\models\Category;
use app\models\Tovar;
use app\models\Clients;
use app\models\Order;
use app\models\OrderItems;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\Event;
use yii\web\View;
use yii\data\Pagination;
// https://codezeel.com/opencart/OPC02/OPC020030/
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
    
    /*
     * send company data to layout
     */
    public function getCompany()
    {
        $company = Company::find()->where(['status' => '1'])->one();
        return $this->view->params['company'] = $company;
    }
        
    /*
     * get currency daily course - http://know-online.com/post/php-valuta
     */
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
    
    /*
     * get Yandex.Metrika
     */
    public function getYandexMetrika()
    {
        $metrika = '<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter51001274 = new Ya.Metrika2({ id:51001274, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/51001274" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->';
        return $this->view->params['metrika'] = $metrika;
    }
    
    /*
     *  random string generation function
     */
    /*public function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }*/
    
    /*
     * set cookie when client adds order to cart
     */
    /*public function setOrderCookie($order_id)
    {
        $orderCookie = new \yii\web\Cookie([
            'name' => 'sbt24order',
            'value' => $order_id,
            'expire' => 86400*30,
        ]);
        Yii::$app->response->cookies->add($orderCookie);
    }*/
    
    /*
     * get order from cookies
     */
    public function getOrderFromCookie()
    {                
        if(Yii::$app->request->cookies->has('sbt24order')) {
            $cookie = Yii::$app->getRequest()->getCookies()->getValue('sbt24order');
            $order = Order::find()->where(['id' => $cookie])->one();
            $orderItems = OrderItems::find()->where(['order_id' => $cookie])->all();
            //$orderItemsCount = OrderItems::find()->where(['order_id' => $cookie])->count();
            $currencies = $this->getCurrencies();            
            
            $orderItemsSum = 0;
            $orderItemsCount = 0;
            foreach ($order['orderItems'] as $item):
                $tovar = Tovar::find()->where(['id' => $item->tovar_id])->one();
                if ($tovar->price_rub != 0) { 
                    $price = round($tovar->price_rub,2);
                } 
                if ($tovar->price_usd != 0) {
                    $price = round(($tovar->price_usd * $currencies['USD']),2);
                } 
                if ($tovar->price_eur != 0) {
                    $price = round(($tovar->price_eur * $currencies['EUR']),2);
                }
                if ($tovar->discount != 0) {
                    $price = round(($price - $price/100*$tovar->discount),2);
                }
                $orderItemsSum = $orderItemsSum + $price*$item->count;
                $orderItemsCount += $item->count;
            endforeach;

            $params = [
                'cookie' => $cookie,
                'order' => $order,
                'orderItems' => $orderItems,
                'orderItemsCount' => $orderItemsCount,
                'orderItemsSum' => $orderItemsSum,
                'tovar' => $tovar,
                'currencies' => $currencies
            ];

            return $params;
        }
        /*else {
            return FALSE;
        }*/
 
    }
    
    
    public function actionIndex()
    {
        $newTovar = Tovar::find()->orderby(['created'=>SORT_ASC])->limit(3)->all();
        $hitTovar = Tovar::find()->where((['hit' => 1]))->orderby(['created'=>SORT_ASC])->limit(3)->all();
        $brands = Tovar::find()->select('brand')->orderby(['brand'=>SORT_ASC])->distinct()->all();
        $currencies = $this->getCurrencies();
        
        $this->view->title = 'Главная';
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'банковское оборудование красноярск'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Специализированное банковское оборудование, сервис, ремонт и сопровождение в Красноярске'
        ]);
        
        return $this->render('index', [
            'newTovar' => $newTovar,
            'hitTovar' => $hitTovar,
            'brands' => $brands,
            'currencies' => $currencies
        ]);
    }
    
    public function actionServices()
    {
        $this->view->title = 'Наши услуги';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'обслуживание, сервис, сопровождение, аренда банковского, офисного оборудования в красноярске'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Услуги по сопровождению, обслуживанию, ремонту, аренде банковского, офисного оборудования, банкоматов в Красноярске'
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
    
    public function actionCatalog()
    {
        $this->view->title = 'Каталог';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'банковское оборудование, офисная техника, системы видеонаблюдения'
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Каталог специализированного банковского оборудования, офисной и климатической техники, систем видеонаблюдения в Красноярске'
        ]);
        
        $model = Category::find()->where(['parent' => 0])->all();

        return $this->render('catalog', [
            'model' => $model,
        ]);
    }
    
    /**
     * Displays a single Catalog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCatalogView($id)
    {
        $model = $this->findCatalogModel($id);      
        $tovar = Tovar::find()->where(['category_id' => $model->id])->all();  
        $sub_category = Category::find()->where(['parent' => $model->id])->all();
        $brands = Tovar::find()->select('brand')->where(['category_id' => $model->id])->orderby(['brand'=>SORT_ASC])->distinct()->all();
        $currencies = $this->getCurrencies();
        
        $catalog_url = '..'.Yii::$app->homeUrl.'catalog';
        $this->view->title = $model->title;
        $this->view->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => [$catalog_url]];
        if (!$sub_category) {
            $sub_category_url = '..'.Yii::$app->homeUrl.'catalog/'.$model->parent;
            $parent_category = Category::find()->where(['id' => $model->parent])->one();
            if ($parent_category) {
                $this->view->params['breadcrumbs'][] = ['label' => $parent_category->title, 'url' => [$sub_category_url]];
            }
        }
        $this->view->params['breadcrumbs'][] = $model->title;
        
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->keywords
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->description
        ]);       
        return $this->render('catalog-view', [
            'model' => $model,
            'sub_category' => $sub_category,
            'tovar' => $tovar,
            'brands' => $brands,
            'currencies' => $currencies
        ]);
    }
    /**
     * Finds the Catalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCatalogModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Displays a single tovar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findTovarModel($id);
        $category = Category::find()->where(['id' => $model->category_id])->one();
        $parent_category = Category::find()->where(['id' => $category->parent])->one();
        
        $currencies = $this->getCurrencies();
        
        $category_url = '..'.Yii::$app->homeUrl.'catalog/'.$model->category_id;
        $parent_category_url = '..'.Yii::$app->homeUrl.'catalog/'.$parent_category->id;
        $catalog_url = '..'.Yii::$app->homeUrl.'catalog';
        
        $this->view->title = $model->name;
        $this->view->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => [$catalog_url]];
        $this->view->params['breadcrumbs'][] = ['label' => $parent_category->name, 'url' => [$parent_category_url]];
        $this->view->params['breadcrumbs'][] = ['label' => $category->name, 'url' => [$category_url]];
        $this->view->params['breadcrumbs'][] = $model->name;
        
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $model->keywords
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $model->description
        ]);  
        
        // настройки view
        if ($model->price_rub != 0) { 
            $price = round($model->price_rub,2);
        } 
        if ($model->price_usd != 0) {
            $price = round(($model->price_usd * $currencies['USD']),2);
        } 
        if ($model->price_eur != 0) {
            $price = round(($model->price_eur * $currencies['EUR']),2);
        }
        if ($model->discount != 0) {
            $discount = '<div class="label discount"><span class="flash animated">'.$model->discount.'%</span></div>';
            $old_price = round($price,2);
            $price = round(($price - $price/100*$model->discount),2);
        } else {
            $discount = '';
            $old_price = '';
        }
        if ($model->hit != 0) {
            $hit = '<div class="label hit"><span><i class="fa fa-star-o" aria-hidden="true"></i></span></div>';
        } else {
            $hit = '';
        }
        if ($model->video != NULL) {
            $video = '<div style="position:relative;height:0;padding-bottom:56.25%;margin-bottom: 15px;"><iframe src="https://www.youtube.com/embed/'. $model->video .'?ecver=2" style="position:absolute;width:100%;height:100%;left:0" width="640" height="360" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>';
        } else {
            $video = '';
        }
        
        // добавляем клиента при добавлении товара в корзину
        $client = new Clients();
        /*$client->contact='new';
        $client->phone='+7';
        $client->email='@';*/
        
        if ( $client->load(Yii::$app->request->post()) && $client->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            $client = new Clients();
        }

        return $this->render('view', [
            'model' => $model,
            'currencies' => $currencies,
            'price' => $price,
            'discount' => $discount,
            'old_price' => $old_price,
            'hit' => $hit,
            'video' => $video,
            'client' => $client
        ]);
    }
    
    public function actionCart()
    {
        $this->view->title = 'Корзина';
        $this->view->params['breadcrumbs'][] = $this->view->title;
        
        \Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => ''
        ]);
        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => ''
        ]);
        
        

        return $this->render('cart',$this->getOrderFromCookie());
    }
    
    /**
     * Deletes an existing order item model.
     * If deletion is successful, the browser will be redirected to the 'cart' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteCartItem($id)
    {
        $this->findOrderItemModel($id)->delete();

        return $this->redirect(['/cart']);
    }
    /**
     * Adds +1 in order item model.
     * If deletion is successful, the browser will be redirected to the 'cart' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionPlusCartItem($id)
    {
        $item = $this->findOrderItemModel($id);
        $item->count += 1;
        $item->save();
        
        return $this->redirect(['/cart']);
    }
    /**
     * Munus +1 from order item model.
     * If deletion is successful, the browser will be redirected to the 'cart' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMinusCartItem($id)
    {
        $item = $this->findOrderItemModel($id);
        
        if($item->count >1) {
            $item->count -= 1;
            $item->save();
        }
        return $this->redirect(['/cart']);
    }
    /**
     * Finds the OrderItemModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return findOrderItemModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findOrderItemModel($id)
    {
        if (($model = OrderItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Build sitemap.xml page
     * http://itelect.ru/post/4/sitemap-dlya-proekta-na-yii2
     */
    public function actionSitemap() {
        $urls = array();
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/']), 'weekly' ]);
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/place-ads']), 'weekly' ]);
        array_push($urls, [ \Yii::$app->urlManager->createUrl(['/category']), 'weekly' ]);

        $categories = Category::find()->all();
        foreach ($categories as $category) {
            array_push($urls, [ \Yii::$app->urlManager->createUrl(['/category/' . $category->id]), 'weekly' ]);
        }

        $tovar_list = Tovar::find()->all();
        foreach ($tovar_list as $tovar) {
            array_push($urls, [ \Yii::$app->urlManager->createUrl(['/view?id=' . $tovar->id]), 'daily' ]);
        }
        
        $xml_sitemap = $this->renderPartial('sitemap', [
            'host' => \Yii::$app->request->hostInfo,
            'urls' => $urls
        ]);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        echo $xml_sitemap;
    }
    
    
    /**
     * Finds the Tovar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findTovarModel($id)
    {
        if (($model = Tovar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * ajax cart-add-client - проверить, надо ли? если нет - удалить views/ajax/cart-to-client
     */
    public function actionCartAddClient()
    {
        $model = new Clients();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->company = 'new';
            $model->save();
        }
        
        return $this->renderAjax('cart-add-client', [
            'model' => $model,
        ]);
    }
}
