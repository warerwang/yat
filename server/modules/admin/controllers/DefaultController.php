<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use app\modules\admin\components\BaseController;
use app\models\forms\LoginForm;

class DefaultController extends BaseController
{
    public function behaviors ()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['signin'],
                        'allow'   => false,
                        'roles'   => ['@'],
                    ],
                    [
                        'actions' => ['signin'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

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

    public function actionIndex ()
    {
        return $this->render('index');
    }

    public function actionSignin ()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
            //return $this->goBack(Yii::$app->getHomeUrl());
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignout ()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
