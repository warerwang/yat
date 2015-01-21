<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/22
 * Time: 上午12:53
 */

namespace app\modules\admin\components;

use Yii;
use yii\web\Controller;

class baseController extends Controller
{
    public $navbarItems = [];
    public $breadcrumbs = [];
    public $menu = [];

    public function init ()
    {
        parent::init();
        $this->navbarItems = [
            ['label' => 'Home', 'url' => ['/admin/index']],
            ['label' => 'Users', 'url' => ['/admin/user']],
            Yii::$app->user->isGuest ? ['label' => 'Login', 'url' => ['/admin/signin']] : [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url'   => ['/admin/signout']
            ],
        ];
    }
}