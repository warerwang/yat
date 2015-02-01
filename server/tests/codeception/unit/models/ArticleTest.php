<?php
/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/2/1
 * Time: 下午5:12
 */

namespace tests\codeception\unit;

use app\models\Article;
use app\models\Category;
use yii\codeception\TestCase;
use Codeception\Specify;
use Codeception\Verify;

class ArticleTest extends TestCase
{
    public $result;

    public function testIndex ()
    {
        $article             = new Article();
        $article->attributes = [
            'cid'     => $this->getCid(),
            'title'   => 'test title',
            'content' => 'test content'
        ];
        $result              = $article->save();
        expect("文章应该被保存成功", $result)->true();

        $last_modified = $article->last_modify;
        sleep(1);
        $article->title = 'new title';
        $result         = $article->update();
        expect("文章应该被修改成功", $result == 1)->true();
        expect("修改标题改变last_modify", $last_modified != $article->last_modify)->true();
        $last_modified = $article->last_modify;
        sleep(1);
        $article->create_time = (new \DateTime())->format('Y-m-d H:i:s');
        $result               = $article->update();
        expect("文章应该被修改成功", $result == 1)->true();
        expect("修改其他字段不改变last_modify", $last_modified != $article->last_modify)->false();
    }

    public function testRule ()
    {

        $article          = new Article();
        $article->cid     = $this->getCid();
        $article->content = 'content';
        expect('缺少标题,保存应该失败', $article->save())->false();


        $article          = new Article();
        $article->title   = 'title';
        $article->content = 'content';
        expect('缺少分类id,保存应该失败', $article->save())->false();

        $article          = new Article();
        $article->cid     = $this->getCid();
        $article->title   = 'title';
        expect('缺少内容,保存应该失败', $article->save())->false();

        $article          = new Article();
        $article->cid     = $this->getCid();
        $article->title   = str_repeat('a', 256);
        $article->content = 'content';
        expect('标题超出长度,保存应该失败', $article->save())->false();

        $article          = new Article();
        $article->cid     = "abcabc";
        $article->title   = 'title';
        $article->content = 'content';
        expect('分类id不存在,保存应该失败', $article->save())->false();
    }

    private function getCid ()
    {
        static $cid;
        if(empty($cid)){
            $cids = Category::getDropListData();
            if(empty($cids)){
                foreach($cids as $k => $v){
                    $cid = $k;
                    break;
                }
            }else{
                $category = CategoryTest::testCreate();
                $cid = $category->id;
            }
        }
        return $cid;
    }
}