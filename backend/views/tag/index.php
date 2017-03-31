<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '标签管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">
    <div style="margin-top:-3%">
        <h3><?= Html::encode($this->title)?></h3>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Tag', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <div class="list-group">
        <div class="list-group-item" style="background-color:#f7f7f7;border-top:3px solid #3c8dbc">
            标签列表
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header'=>'序号',
                ],

                [
                    'attribute'=>'name',
                    'header'=>'标签名称',
                ],
                [
                    'attribute'=>'frequency',
                    'header'=>'文章数',
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'操作',
                    'template'=>'{update}{delete}',
                    'buttons'=>[
                        'delete'=>function($url,$model,$key)
                        {
                            $url =Url::to(['novel/delete','id'=>$model->id]);
                            $name = '删除这个标签';
                            $options =[
                                'title'=>Yii::t('yii','删除'),
                                'aria-label'=>Yii::t('yii','删除'),
                                'onclick'=>'javascript:promptmessage(\''.$url.'\',\''.$name.'\')',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>','#',$options);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
