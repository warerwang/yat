<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property integer $group_id
 * @property string $nickname
 * @property string $access_token
 * @property string $create_time
 * @property string $last_activity
 */
class UsersBase extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'email', 'password', 'salt', 'nickname'], 'required'],
            [['group_id'], 'integer'],
            [['create_time', 'last_activity'], 'safe'],
            [['id'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            [['password', 'access_token'], 'string', 'max' => 32],
            [['salt'], 'string', 'max' => 8],
            [['nickname'], 'string', 'max' => 50],
            [['access_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'salt' => 'Salt',
            'group_id' => 'Group ID',
            'nickname' => 'Nickname',
            'access_token' => 'Access Token',
            'create_time' => 'Create Time',
            'last_activity' => 'Last Activity',
        ];
    }
}
