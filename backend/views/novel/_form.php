<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Author;
use common\models\Tag;

/* @var $this yii\web\View */
/* @var $model common\models\Novel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="novel-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-9">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tags')->dropDownList(Tag::find()
                                                        ->select(['name','id'])
                                                        ->indexBy('id')
                                                        ->column(),['prompt'=>'请选择']) ?>

        <?= $form->field($model, 'author_id')->dropDownList(Author::find()->select(['pseudonym','userid'])->indexBy('userid')->column(),['prompt'=>'请选择']) ?>

        <!--    --><?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
        <?= $form->field($model,'content')->widget('yidashi\markdown\Markdown',['language'=>'zh']) ?>

    </div>

    <div class="col-lg-3">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord?'发布':'保存', ['class' => 'btn btn-success btn-block']) ?>
        </div>

        <?= $form->field($model, 'is_top')->checkbox() ?>
        
        <?= $form->field($model, 'is_hot')->checkbox() ?>

        <?= $form->field($model, 'is_best')->checkbox() ?>

        <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['N_status'],['prompt'=>'请选择']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
