<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 上午12:58
 */

namespace app\models;

use app\models\base\CategoryBase;
use yii\data\ActiveDataProvider;

class Category extends CategoryBase
{
    public $sort = 100;
//    public function fields()
//    {
//        return [
//            'id',
//            'name',
//            'sort'
//        ];
//    }

    public function beforeValidate ()
    {
        if (parent::beforeValidate()) {
            if ($this->getOldAttribute('name') !== $this->name || $this->getOldAttribute('sort') !== $this->sort
            ) {
                $this->last_modify = (new \DateTime())->format("Y-m-d H:i:s");
            }

            return true;
        }
        return false;
    }

    public static function getDropListData ()
    {
        $lists     = [];
        $categorys = self::find()->andWhere('sort > 0')->addOrderBy('sort ASC')->all();
        foreach ($categorys as $v) {
            $lists[$v->id] = $v->name;
        }

        return $lists;
    }

    public function search ($params = [])
    {
        $query        = self::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'attributes'   => [
                    'sort',
                ],
                'defaultOrder' => [
                    'sort' => SORT_ASC
                ]
            ]
        ]);
        //没有传入
        if (!$this->load($params) && $this->validate()) {
            return $dataProvider;
        } else {
            $query->andFilterWhere(['like', 'name', $this->name]);
            return $dataProvider;
        }
    }

    public function getArticles ()
    {
        return $this->hasMany(Article::className(), ['cid' => 'id']);
    }
}