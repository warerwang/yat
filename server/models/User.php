<?php

namespace app\models;
use app\models\base\UsersBase;

class User extends UsersBase implements \yii\web\IdentityInterface
{
    const GROUP_ADMIN = 1;
    public $authKey;
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access-token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string $email
     * @return static|null
     */
    public static function findByUsername($email)
    {
        return self::findOne(['email' => $email]);
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password . $this->salt);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->nickname ?: $this->email;
    }
}
