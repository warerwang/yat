<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 下午11:16
 */

namespace app\controllers;

use app\components\RestController;
use app\models\Article;
use app\models\Category;

/**
 *
 * Swagger Annotations
 * @SWG\Resource(
 *      resourcePath="/article",
 *      basePath="/",
 *      description="article api"
 * )
 * @SWG\Model(id="Article", description="文章模型")(
 *      @SWG\Property(name="id",type="string"),
 *      @SWG\Property(name="cid",type="string"),
 *      @SWG\Property(name="title",type="string"),
 *      @SWG\Property(name="content",type="string"),
 *      @SWG\Property(name="summary",type="string"),
 *      @SWG\Property(name="create_time",type="string"),
 *      @SWG\Property(name="last_modify",type="string"),
 * )
 */
class ArticleController extends RestController
{
    public $safeActions = ['index', 'view'];
    /**
     * @SWG\Api(
     *   path="/article",
     *   description="文章相关接口api",
     *   @SWG\Operation(
     *      method="GET",
     *      type="array",
     *      @SWG\Items("Article"),
     *      nickname="list",
     *      notes="得到所有文章列表",
     *      @SWG\Parameter(
     *          name="page",
     *          paramType="query",
     *          required=false,
     *          type="integer",
     *          description="页码"
     *      ),
     *   )
     * )
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex ()
    {
        $article = new Article();
        return $article->search();
    }

    /**
     *   @SWG\Api(
     *   path="/article/{id}",
     *   description="指定文章的相关接口",
     *   @SWG\Operation(
     *      method="GET",
     *      type="Article",
     *      nickname="view",
     *      notes="得到文章的详细信息",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="文章id"
     *      ),
     *   )
     * )
     * @param $id
     *
     * @return static
     */
    public function actionView ($id)
    {
        \Yii::$app->request->setQueryParams(['expand' => 'content,category']);
        return Article::findOne($id);
    }


} 