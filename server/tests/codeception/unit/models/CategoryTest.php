<?php

namespace tests\codeception\unit;

use app\models\Category;
use yii\codeception\TestCase;
use Codeception\Specify;

/**
 * Created by PhpStorm.
 * User: yadongwang
 * Date: 15/2/1
 * Time: 下午8:28
 */
class CategoryTest extends TestCase
{
    public function testCreate ()
    {
        $category = new Category();
        $category->name = 'abc';
        expect('保存成功', $category->save())->true();
        return $category;
    }

    public function testMissName ()
    {
        $category = new Category();
        $category->name = '';
        expect('缺少名字保存分类应该失败', $category->save())->false();

        $category = new Category();
        $category->name = str_repeat('a',51);
        expect('分类名字过长应该失败', $category->save())->false();

        $category = new Category();
        $category->name = 'abc';
        $category->sort = 'abc';
        expect('排序不能为字符串', $category->save())->false();
    }

    public function testDropList()
    {
        $listData = Category::getDropListData();
        expect('应该是一个数组.', count($listData) > 0)->true();
    }
} 