<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/1/29
 * Time: 下午11:16
 */

namespace app\controllers;

use app\components\RestController;
use app\components\Tools;
use app\exceptions\UserException;
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
    public $safeActions = ['index', 'view', 'list'];
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
     *   @SWG\Operation(
     *      method="POST",
     *      type="Category",
     *      nickname="create",
     *      notes="添加一个分类",
     *      @SWG\Parameter(
     *          type="Category",
     *          paramType="body",
     *          required=true,
     *          description="内容"
     *      ),
     *   )
     * )
     */
    public function actionIndex ()
    {
        $category= new Category();
        return $category->search(\Yii::$app->request->get());
    }

    public function actionCreate ()
    {
        $model = new Category();
        $data = json_decode(\Yii::$app->request->rawBody, true);
        $model->load([$model->formName() => $data]);
        if(!$model->save()){
            if($model->errors){
                throw new UserException(Tools::getFirstError($model));
            }else{
                throw new UserException($this->errorMessage[self::DB_ERROR], self::DB_ERROR);
            }
        }
        return $model;
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
     *   @SWG\Operation(
     *      method="PUT",
     *      type="Category",
     *      nickname="create",
     *      notes="修改指定分类",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="分类id"
     *      ),
     *      @SWG\Parameter(
     *          type="Category",
     *          paramType="body",
     *          required=true,
     *          description="内容"
     *      ),
     *   ),
     *   @SWG\Operation(
     *      method="DELETE",
     *      type="boolean",
     *      nickname="delete",
     *      notes="删除一个分类",
     *      @SWG\Parameter(
     *          name="id",
     *          paramType="path",
     *          required=true,
     *          type="string",
     *          description="分类id"
     *      ),
     *   )
     * )
     */
    public function actionView ($id)
    {
        $category = $this->findModel($id);
        return $category;
    }


    public function actionUpdate ($id)
    {
        $model = $this->findModel($id);
        $data = json_decode(\Yii::$app->request->rawBody, true);
        $model->load([$model->formName() => $data]);
        if($model->save()){
            return $model;
        }else{
            if($model->errors){
                throw new UserException(Tools::getFirstError($model));
            }else{
                throw new UserException($this->errorMessage[self::DB_ERROR], self::DB_ERROR);
            }
        }
    }

    public function actionDelete ($id)
    {
        $model = $this->findModel($id);
        if($model->delete()){
            return true;
        }else{
            throw new UserException($this->errorMessage[self::DB_ERROR], self::DB_ERROR);
        }
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