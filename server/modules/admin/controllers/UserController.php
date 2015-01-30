<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/23
 * Time: 上午1:28
 */

namespace app\modules\admin\controllers;

use yii\filters\AccessControl;
use app\modules\admin\components\BaseController;

class UserController extends BaseController
{
    public $menu = [
        ['label' => '创建用户', 'url' => ['user/add']],
        ['label' => '用户列表', 'url' => ['user/index']],
    ];

    public function behaviors ()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex ()
    {
        return $this->render('index');
    }
}