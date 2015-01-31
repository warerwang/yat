<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\app\assets\SummernoteAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'cid')->dropDownList($categoryList) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<<EOF
$(function(){
    $('#article-content').summernote(
    {
        height: 300,
        lang:"zh-CN"
    }
    );
});
EOF;
$this->registerJs($js);
?>
