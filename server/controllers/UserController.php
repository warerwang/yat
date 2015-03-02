<?php

namespace app\controllers;

use app\components\RestController;
use app\exceptions\UserException;
use app\models\User;
use Yii;
use app\models\UserSearch;

/**
 * Swagger Annotations
 * @SWG\Resource(
 *      resourcePath="/user",
 *      basePath="/",
 *      description="user api"
 * )
 * @SWG\Model(id="User", description="用户模型")(
 * @SWG\Property(name="id",type="string"),
 * @SWG\Property(name="email",type="string"),
 * @SWG\Property(name="group_id",type="string"),
 * @SWG\Property(name="nickname",type="string"),
 * @SWG\Property(name="access_token",type="string"),
 * @SWG\Property(name="create_time",type="string"),
 * @SWG\Property(name="last_activity",type="string"),
 * )

 */
class UserController extends RestController
{
    /**
     * @param \app\models\User $user
     */
    public function checkAccess($user)
    {
        if(empty($user)){
            throw new UserException("用户不存在.");
        }
    }
    public function actionIndex ()
    {
        //        return $category;
    }

    /**
     * @SWG\Api(
     *   path="/user/{id}",
     *   description="用户信息相关接口",
     *   @SWG\Operation(
     *      method="GET",
     *      type="User",
     *      nickname="view",
     *      notes="查询用户信息",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="用户id"
     *      ),
     *   ),
     *   @SWG\Operation(
     *      method="PUT",
     *      type="User",
     *      nickname="update",
     *      notes="更新用户信息",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="用户id"
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          paramType="form",
     *          required=false,
     *          type="string",
     *          description="用户昵称"
     *      ),
     *   ),
     * )
     */
    public function actionView ($id)
    {
        $user = User::findOne($id);

        return $user;
    }

    public function actionUpdate ($id)
    {
        $request  = Yii::$app->request;
        $nickname = $request->post('nickname');
        $user     = User::findOne($id);
        $this->checkAccess($user);
        $user->nickname = $nickname;

        return $user;
    }

    /**
     * @SWG\Api(
     *   path="/user",
     *   description="用户信息相关接口",
     *   @SWG\Operation(
     *      method="POST",
     *      type="User",
     *      nickname="create",
     *      notes="注册用户",
     *      @SWG\Parameter(
     *          name="email",
     *          paramType="form",
     *          required=true,
     *          type="string",
     *          description="用户email"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          paramType="form",
     *          required=true,
     *          type="string",
     *          description="用户密码"
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          paramType="form",
     *          required=false,
     *          type="string",
     *          description="用户昵称"
     *      ),
     *   ),
     * )
     */


    public function actionCreate ()
    {
        $request  = Yii::$app->request;
        $email    = $request->post('email');
        $password = $request->post('password');
        $nickname = $request->post('nickname');

        return User::create($email, $password, User::GROUP_USER, $nickname);
    }
}
