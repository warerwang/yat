<?php

namespace app\modules\admin;

use yii;
class admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
        Yii::$app->errorHandler->errorAction = 'admin/default/error';
        Yii::$app->user->loginUrl = ['admin/default/sign-in'];
        \Yii::$app->setHomeUrl(['/admin']);
    }
}
