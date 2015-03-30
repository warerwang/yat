<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 下午11:17
 */

namespace app\components;

use yii\rest\Controller;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class RestController extends Controller
{
    public $safeActions = [];
    public function behaviors ()
    {
        $behaviors                  = parent::behaviors();
        if(!in_array($this->action->id, $this->safeActions)){
            $behaviors['authenticator'] = [
                'class'       => CompositeAuth::className(),
                'authMethods' => [
                    HttpBearerAuth::className(),
                    QueryParamAuth::className(),
                ],
            ];
        }
        return $behaviors;
    }
} 