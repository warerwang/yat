<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $name
 * @property string $create_time
 * @property string $last_modify
 * @property integer $sort
 */
class CategoryBase extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['create_time', 'last_modify'], 'safe'],
            [['sort'], 'integer'],
            [['id'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_time' => 'Create Time',
            'last_modify' => 'Last Modify',
            'sort' => 'Sort',
        ];
    }
}
