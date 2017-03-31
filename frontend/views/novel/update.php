<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Novel */

$this->title = 'Update Novel: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Novels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
