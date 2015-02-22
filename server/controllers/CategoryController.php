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
use yii\web\NotFoundHttpException;

/**
 *
 * Swagger Annotations
 * @SWG\Resource(
 *      resourcePath="/category",
 *      basePath="/",
 *      description="category api"
 * )
 * @SWG\Model(id="Category", description="分类模型")(
 *      @SWG\Property(name="id",type="string"),
 *      @SWG\Property(name="name",type="string"),
 *      @SWG\Property(name="create_time",type="string"),
 *      @SWG\Property(name="last_modify",type="string"),
 *      @SWG\Property(name="sort",type="integer"),
 * )
 *
 */
class CategoryController extends RestController
{
    /**
     * @SWG\Api(
     *   path="/category",
     *   description="分类相关接口",
     *   @SWG\Operation(
     *      method="GET",
     *      type="array",
     *      @SWG\Items("Category"),
     *      nickname="index",
     *      notes="得到分类列表",
     *      @SWG\Parameter(
     *          name="page",
     *          paramType="query",
     *          required=false,
     *          type="integer",
     *          description="页码"
     *      ),
     *   ),
     * )
     */
    public function actionIndex ()
    {
        $category= new Category();
        return $category->search(\Yii::$app->request->get());
    }

    /**
     * @SWG\Api(
     *   path="/category/{id}",
     *   description="指定分类相关接口",
     *   @SWG\Operation(
     *      method="GET",
     *      type="Category",
     *      nickname="view",
     *      notes="查询指定分类",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="分类id"
     *      ),
     *   ),
     * )
     */
    public function actionView ($id)
    {
        $category = $this->findModel($id);
        return $category;
    }

    /**
     * @SWG\Api(
     *   path="/category/{id}/articles",
     *   description="查询指定分类下的文件列表",
     *   @SWG\Operation(
     *      method="GET",
     *      type="array",
     *      @SWG\Items("Article"),
     *      nickname="list",
     *      notes="查询指定分类的文件列表",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="分类id"
     *      ),
     *      @SWG\Parameter(
     *          name="page",
     *          paramType="query",
     *          required=false,
     *          type="integer",
     *          description="页码"
     *      ),
     *   ),
     * )
     */
    public function actionList ($id)
    {
        $category = $this->findModel($id);
        $article = new Article();
        $article->cid = $category->id;
        return $article->search();
    }

    protected function findModel($id)
    {
        $model = Category::findOne($id);
        if(empty($model)){
            throw new NotFoundHttpException("Category is not exist.");
        }
        return $model;
    }

} 