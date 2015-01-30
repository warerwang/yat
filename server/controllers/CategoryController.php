<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 下午11:16
 */

namespace app\controllers;

use app\components\RestController;
use app\models\Category;
use yii\web\NotFoundHttpException;

class CategoryController extends RestController
{
    public function actionIndex ()
    {
        return ['data' => Category::find()->all()];
    }

    public function actionView ($id)
    {
        $category = $this->findModel($id);
        return ['data' => $category];
    }

    public function actionList ($id)
    {
        $category = $this->findModel($id);
        return [
            'data' => $category->articles
        ];
    }

    protected function findModel($id)
    {
        $model = Category::findOne($id);
        if(empty($model)){
            throw new NotFoundHttpException("Category is not exist.");
        }
        return $model;
    }

} 