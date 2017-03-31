<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Novel */

$this->title = 'Create Novel';
$this->params['breadcrumbs'][] = ['label' => 'Novels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
