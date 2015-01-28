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

class Article extends ArticleBase
{
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
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cid'=> $this->cid,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}