<?php
namespace app\components;

use Yii;
use yii\web\UrlRuleInterface;
use yii\base\Object;
use app\models\Category;

/*
https://mariit.ru/articles/ispolzovanie-createurl-v-yii2
https://dev-tips.ru/blog/post/yii2-napisanie-pravil-razbora-i-postroeniya-url
*/

class CatalogRules extends Object implements UrlRuleInterface {
    public function createUrl($manager, $route, $params){
        /*if ($route === 'site/catalog-view' || isset($params['id']) !== false) {
            $link = Category::find()->select('link')->where(['id' => $params['id']])->one();
            if ($link !== false) {
                //echo $link;
                return 'catalog/' . $link;
            }
        }*/
        //echo $params['id'];
        return false;
    }

    public function parseRequest($manager, $request){
        $url = trim($request->pathInfo, '/'); // удаляем слеши из начала и конца url
        //$url = $request->pathInfo;
        echo $url;
        $category = Category::find() // ищем запись по url
            ->where(
                [
                    'link' => $url,
                    //'active' => 1,
                ]
            )->one();
        if ($category !== null) { // если нашли, то передаем данные в PageController::actionShow($id). В нем будем рендерить страницу
            return ['catalog/', ['link' => $category->id]];
            //return ['site/catalog-view', ['id' => $category->id]];
        }
        return false; // сообщаем UrlManager, что ничего не нащли и необходимо попробовать применит следующее правило
    }
}