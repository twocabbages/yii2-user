<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14-8-3
 * Time: 下午7:13
 */

namespace user\controllers;

use Yii;
use yii\web\Controller as BaseController;
use yii\web\Response;
use yii\web\UrlManager;


class Controller extends BaseController
{
    public $layout = '@user/views/layouts/main';

    public function goHome()
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl(['user/profile/view']));
    }

    public function goWebHome(){
        parent::goHome();
    }
}