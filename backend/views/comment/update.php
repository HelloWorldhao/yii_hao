<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\comment */

$this->title = '修改评论';
$this->params['breadcrumbs'][] = ['label' => '评论管理', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改评论';
?>
<div class="comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
