<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 上午12:57
 */

namespace app\models;

use app\models\base\ArticleBase;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class Article extends ArticleBase
{
    public function rules ()
    {
        $rules =  parent::rules();
        return array_merge($rules,[
            ['cid', 'exist', 'targetClass' => '\app\models\Category', 'targetAttribute' => 'id'],
        ]);
    }

    public function fields()
    {
        return [
            'id',
            'cid',
            'title',
            'create_time',
            'last_modify',
            'summary' => function(){
                return mb_substr(strtr(
                    strip_tags($this->content), ['&nbsp;' => '']
                ), 0 , 200);
            }
        ];
    }

    public function extraFields()
    {
        return [
            'category' => function(){
                return $this->category;
                },
            'content'
        ];
    }

    public function beforeValidate ()
    {
        if (parent::beforeValidate()) {
            if ($this->getOldAttribute('cid') !== $this->cid ||
                $this->getOldAttribute('title') !== $this->title ||
                $this->getOldAttribute('content') !== $this->content
            ) {
                $this->last_modify = (new \DateTime())->format("Y-m-d H:i:s");
            }
            return true;
        }
        return false;
    }

    public function getCategory ()
    {
        return $this->hasOne(Category::className(), ['id' => 'cid']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'attributes'   => [
                    'last_modify',
                ],
                'defaultOrder' => [
                    'last_modify' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if(!$this->load($params) && $this->validate()){
            return $dataProvider;
        }

        $query->andFilterWhere(['cid' => $this->cid]);
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}