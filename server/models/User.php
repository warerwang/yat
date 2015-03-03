<?php

namespace app\models;

use app\components\Tools;
use app\exceptions\UserException;
use app\models\base\UsersBase;
use yii\base\ModelEvent;
use yii\db\BaseActiveRecord;
use yii\db\Exception;

class User extends UsersBase implements \yii\web\IdentityInterface
{
    const GROUP_ADMIN = 1;
    const GROUP_USER  = 2;

    const EXPIRE_TIME = 3600;

    public $groups = [
        self::GROUP_ADMIN => '管理员',
        self::GROUP_USER  => '普通用户',
    ];
    public $authKey;

    public function fields ()
    {
        return [
            'id',
            'email',
            'group_id',
            'nickname',
            'access_token',
            'create_time',
            'last_activity'
        ];
    }

    public function rules ()
    {
        $rules = parent::rules();

        return array_merge([
            ['email', 'email'],
            ['group_id', 'in', 'range' => [self::GROUP_USER, self::GROUP_ADMIN]]
        ], $rules);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity ($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken ($token, $type = null)
    {
        return self::find()->andWhere(['access_token' => $token])->andWhere('last_activity	> ' . (time() - self::EXPIRE_TIME))->one();
//        return self::findOne(['access-token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string $email
     *
     * @return static|null
     */
    public static function findByUsername ($email)
    {
        return self::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey ()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey ($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     *
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword ($password)
    {
        return $this->password === md5($password . $this->salt);
    }

    /**
     * @inheritdoc
     */
    public function getId ()
    {
        return $this->id;
    }

    public function getName ()
    {
        return $this->nickname ? : $this->email;
    }

    public function afterFind ()
    {
        parent::afterFind();
        $this->updateAttributes(['last_activity' => (new \DateTime())->format('Y-m-d H:i:s')]);
    }

    public static function create ($email, $password, $group_id = self::GROUP_USER, $nickname = '')
    {
        $user           = new self();
        $user->email    = $email;
        $user->salt     = strval(rand(100000, 999999));
        $user->password = md5($password . $user->salt);
        $user->group_id = $group_id;
        $user->nickname = $nickname;
        $user->access_token = md5(microtime(true));
        if ($user->save()) {
            return $user;
        } else {
            throw new UserException("注册用户失败,错误信息: " . Tools::getFirstError($user));
        }
    }
}
