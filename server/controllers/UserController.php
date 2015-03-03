<?php

namespace app\controllers;

use app\components\RestController;
use app\exceptions\UserException;
use app\models\User;
use Yii;

use yii\filters\ContentNegotiator;
use yii\web\Response;

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
 * @SWG\Model(id="AccessToken", description="登陆凭证")(
 * @SWG\Property(name="access_token",type="string"),
 * @SWG\Property(name="expire_time",type="string"),
 * )

 */
class UserController extends RestController
{
    public function behaviors ()
    {
        if (in_array($this->action->id, ['view','create', 'access-token'])) {

            return [
                'contentNegotiator' => [
                    'class'   => ContentNegotiator::className(),
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON,
                        'application/xml'  => Response::FORMAT_XML,
                    ],
                ],
            ];
        } else {
            return parent::behaviors();
        }
    }

    /**
     * @param \app\models\User $user
     */
    public function checkAccess ($user)
    {
        if (empty($user)) {
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
     *          description="用户id或者email"
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
        $user = $this->findModel($id);
        $this->checkAccess($user);

        return $user;
    }

    public function actionUpdate ($id)
    {
        $request  = Yii::$app->request;
        $nickname = $request->post('nickname');
        $user     = $this->findModel($id);
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

    /**
     * @SWG\Api(
     *   path="/user/access-token",
     *   description="Access-token相关接口",
     *   @SWG\Operation(
     *      method="GET",
     *      type="User",
     *      nickname="create",
     *      notes="用户登陆",
     *      @SWG\Parameter(
     *          name="email",
     *          paramType="query",
     *          required=true,
     *          type="string",
     *          description="用户email"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          paramType="query",
     *          required=true,
     *          type="string",
     *          description="用户密码"
     *      ),
     *   ),
     * )
     */
    public function actionAccessToken ()
    {
        $request  = Yii::$app->request;
        $email    = $request->get('email');
        $password = $request->get('password');
        $user     = User::findOne(['email' => $email]);
        if (empty($user)) {
            throw new UserException(UserException::USER_IS_NOT_EXIST, UserException::USER_IS_NOT_EXIST_CODE);
        }
        if (!$user->validatePassword($password)) {
            throw new UserException(UserException::PASSWORD_IS_INVALID, UserException::PASSWORD_IS_INVALID_CODE);
        }

        return [
            'access_token' => $user->access_token,
            'expire_time'  => time() + User::EXPIRE_TIME
        ];
    }

    public function actionUpdatePassword ($oldpassword, $newpassword)
    {
    }

    public function actionGetResetPasswordCode ($email)
    {
    }

    public function actionUpdatePasswordByResetCode ($email, $code, $password)
    {
    }

    private function findModel ($idOrEmail)
    {
        if (strpos($idOrEmail, '@') === false) {
            return User::findOne($idOrEmail);
        } else {
            return User::findOne(['email' => $idOrEmail]);
        }
    }
}
