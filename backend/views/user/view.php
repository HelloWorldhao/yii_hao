<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'pseudonym',
            'email:email',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return Yii::$app->params['U_status'][$model->status];
                }
            ],
            [
                'attribute'=>'created_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            [
                'attribute'=>'updated_at',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除该用户嘛?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
