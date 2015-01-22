<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\AccessControl;
use app\modules\admin\components\BaseController;
use app\models\LoginForm;

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
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex ()
    {
//        User::className()
        return $this->render('index');
    }

    public function actionSignin ()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
