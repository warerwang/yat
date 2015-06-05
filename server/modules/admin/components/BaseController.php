<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/22
 * Time: 上午12:53
 */

namespace app\modules\admin\components;

use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class BaseController extends Controller
{
    public $navbarItems = [];
    public $breadcrumbs = [];
    public $menu = [];

    public function init ()
    {
        parent::init();
        $this->layout = 'main';
        $webUser = Yii::$app->user;
        if($webUser->isGuest){
            $this->navbarItems[] = ['label' => 'Login', 'url' => ['default/signin']];
//        }elseif($webUser->identity->group_id != User::GROUP_ADMIN){
//            throw new ForbiddenHttpException("Forbidden");
        }else{
            $this->navbarItems = [
                ['label' => '首页', 'url' => ['default/index']],
                ['label' => '用户', 'url' => ['user/index']],
                ['label' => '分类', 'url' => ['category/index']],
                ['label' => '文章', 'url' => ['article/index']],
                ['label' => '退出 (' . $webUser->identity->name . ')','url'   => ['default/sign-out']],
            ];
        }

    }
}