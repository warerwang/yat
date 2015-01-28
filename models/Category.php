<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 上午12:58
 */

namespace app\models;

use app\models\base\CategoryBase;

class Category extends CategoryBase
{
    public function beforeValidate ()
    {
        if (parent::beforeValidate()) {
            if ($this->getOldAttribute('name') !== $this->name || $this->getOldAttribute('sort') !== $this->sort
            ) {
                $this->last_modify = (new \DateTime())->format("Y-m-d H:i:s");
            }
            return true;
        }
    }

    public static function getDropListData ()
    {
        $lists = [];
        $categorys = self::find()->andWhere('sort > 0')->addOrderBy('sort ASC')->all();
        foreach($categorys as $v){
            $lists[$v->id] = $v->name;
        }
        return $lists;
    }

    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['id' => 'cid']);
    }
}