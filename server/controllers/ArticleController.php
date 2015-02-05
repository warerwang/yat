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
 *      @SWG\Property(name="create_time",type="string"),
 *      @SWG\Property(name="last_modify",type="string"),
 * )
 *
 *
 * @SWG\Api(
 *   path="/article",
 *   description="文章相关接口api",
 *   @SWG\Operation(
 *      method="GET",
 *      type="array",
 *      @SWG\Items("Article"),
 *      nickname="list",
 *      notes="得到文章列表",
 *   ),
 *   @SWG\Operation(
 *      method="POST",
 *      type="Article",
 *      nickname="create",
 *      notes="添加一篇文章",
 *      @SWG\Parameter(
 *          name="cid",
 *          paramType="form",
 *          required=true,
 *          type="string",
 *          description="分类id"
 *      ),
 *      @SWG\Parameter(
 *          name="title",
 *          paramType="form",
 *          required=true,
 *          type="string",
 *          description="文章标题"
 *      ),
 *      @SWG\Parameter(
 *          name="content",
 *          paramType="form",
 *          required=true,
 *          type="string",
 *          description="文章描述"
 *      ),
 *   ),
 * )
 */
class ArticleController extends RestController
{
    public function actionIndex ()
    {
        return ['data' => Article::find()->all()];
    }

    public function actionView ($id)
    {
        return ['data' => Article::findOne($id)];
    }


} 