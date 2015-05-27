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
use app\models\Article;
use app\models\Category;
use yii\base\UserException;
use yii\web\NotFoundHttpException;

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
    const ARTICLE_IS_NOT_EXIST = 200001;

    public function init ()
    {
        $this->errorMessage = array_merge(
            [
                self::ARTICLE_IS_NOT_EXIST => '文章不存在'
            ]
            , $this->errorMessage
        );
    }

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
     *   ),
     *   @SWG\Operation(
     *      method="POST",
     *      type="Article",
     *      nickname="create",
     *      notes="添加一篇文章",
     *      @SWG\Parameter(
     *          type="Article",
     *          paramType="body",
     *          required=true,
     *          description="内容, cid, title, content这三个参数必选"
     *      ),
     *   )
     * )
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex ()
    {
        $article = new Article();
        $article->cid = \Yii::$app->request->get('cid');
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
        $model = Article::findOne($id);
        $this->checkModel($model);
        return $model;
    }

    /**
     * @return Article
     * @throws \yii\base\UserException
     */
    public function actionCreate ()
    {
        $model = new Article();
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

    public function actionUpdate ($id)
    {
        $model = Article::findOne($id);
        $this->checkModel($model);
        $data = json_decode(\Yii::$app->request->rawBody, true);

    }

    public function actionDelete ($id)
    {
        $model = Article::findOne($id);
        $this->checkModel($model);
        if($model->delete()){
            return true;
        }else{
            throw new UserException($this->errorMessage[self::DB_ERROR], self::DB_ERROR);
        }
    }

    public function checkModel($model)
    {
        if(empty($model)) {
            throw new NotFoundHttpException($this->errorMessage[self::ARTICLE_IS_NOT_EXIST], self::ARTICLE_IS_NOT_EXIST);
        }
    }
} 