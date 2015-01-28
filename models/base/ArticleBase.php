<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property string $id
 * @property string $cid
 * @property string $title
 * @property string $content
 * @property string $create_time
 * @property string $last_modify
 */
class ArticleBase extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'title', 'content'], 'required'],
            [['content'], 'string'],
            [['create_time', 'last_modify'], 'safe'],
            [['id', 'cid'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'title' => 'Title',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'last_modify' => 'Last Modify',
        ];
    }
}
