<?php

namespace app\modules\admin;

class admin extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
        \Yii::$app->setHomeUrl(['/admin']);
    }
}
