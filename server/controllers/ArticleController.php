<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 下午11:16
 */

namespace app\controllers;

use app\components\RestController;
use app\models\Article;
use app\models\Category;

class ArticleController extends RestController
{
    public function actionIndex ()
    {
        return ['data' => Article::find()->all()];
    }

    public function actionView ($id)
    {
        return ['data' => Article::findOne($id)];
    }


} 