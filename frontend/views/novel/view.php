<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Novel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Novels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',
            'tags:ntext',
            'status',
            'is_top',
            'is_hot',
            'is_best',
            'create_time:datetime',
            'update_time:datetime',
            'author_id',
        ],
    ]) ?>
    </div>
</div>
