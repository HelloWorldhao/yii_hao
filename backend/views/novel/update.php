<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Novel */

$this->title = '更新文章';
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新文章';
?>
<div class="novel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>