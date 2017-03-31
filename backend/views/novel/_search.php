<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NovelSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="list-group">
    <div class="list-group-item" style="background-color:#f7f7f7;color:#669fc7;border-top:3px solid #3c8dbc">查询条件</div>
    <div class="list-group-item novel-search" style="height:75px">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'fieldConfig'=>[
                'template'=>'<div class="form-group" style="float:left;width:300px;">{label}{input}</div>',
                'labelOptions'=>['style'=>'width:50px'],
            ],
        ]); ?>

        <?= $form->field($model, 'title')->textInput(['class'=>'','style'=>'width:150px']) ?>

        <?php  echo $form->field($model, 'authorName')->textInput(['class'=>'','style'=>'width:150px']) ?>

        <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['N_status'],['prompt'=>'请选择','class'=>'','style'=>'width:120px']) ?>

        <div class="form-group" style="float:right">
            <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('重置',['index'],['class' => 'btn btn-default']) ?>
            <?= Html::a('创建', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
