<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NovelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="novel-index" xmlns="http://www.w3.org/1999/html">
    <div style="margin-top:-3%">
        <h3><?= Html::encode($this->title)?></h3>
    </div>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="list-group">
        <div class="list-group-item" style="background-color:#f7f7f7;border-top:3px solid #3c8dbc">
            文章列表
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
    //        'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header'=>'序号',
    //                'headerOptions'=>['width'=>50],
                ],

                [
                    'attribute'=>'title',
                    'header'=>'标题',
                ],
                [
                    'attribute'=>'author_id',
                    'header'=>'作者',
                    'value'=>'author.pseudonym',
    //                'value'=>function($model)
    //                {
    //                    return $model->author->pseudonym;
    //                }
                ],
                [
                    'attribute'=>'tags',
                    'header'=>'标签',
                    'value'=>'tag.name'
                ],
                [
                    'attribute'=>'is_hot',
                    'format'=>'raw',
                    'value'=>function($model)
                    {
                        if($model->is_hot == '1')
                        {
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-ok']);
                        }else{
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-remove']);
                        }
                    }
                ],
                [
                    'attribute'=>'is_top',
                    'format'=>'raw',
                    'value'=>function($model)
                    {
                        if($model->is_top == '1')
                        {
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-ok']);
                        }else{
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-remove']);
                        }
                    }
                ],
                [
                    'attribute'=>'is_best',
                    'format'=>'raw',
                    'value'=>function($model)
                    {
                        if($model->is_best == '1')
                        {
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-ok']);
                        }else{
                            return Html::tag('span','',['class'=>'glyphicon glyphicon-remove']);
                        }
                    }
                ],
                [
                    'attribute'=>'status',
                    'header'=>'状态',
                    'value'=>function($model){
                        return Yii::$app->params['N_status'][$model->status];
                    },
                    'contentOptions'=>function($model){
                        return ($model->status == 1)?['class'=>'bg-danger']:[];
                    }
                ],
    //             'create_time:datetime',
                [
                    'attribute'=>'create_time',
                    'header'=>'创建时间',
                    'format'=>['date','php:Y-m-d H:i:s'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'操作',
                    'template'=>'{update}{delete}{approve}',
                    'buttons'=>[
                        'delete'=>function($url,$model,$key)
                        {
                            $url =Url::to(['novel/delete','id'=>$model->id]);
                            $name = '删除这篇文章';
                            $options =[
                                'title'=>Yii::t('yii','删除'),
                                'aria-label'=>Yii::t('yii','删除'),
                                'onclick'=>'javascript:promptmessage(\''.$url.'\',\''.$name.'\')',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>','#',$options);
                        },
                        'approve'=>function($url,$model,$key)
                        {
                            $url =Url::to(['novel/approve','id'=>$model->id]);
                            $name = '通过这篇文章';
                            $options =[
                                'title'=>Yii::t('yii','审核'),
                                'aria-label'=>Yii::t('yii','审核'),
                                'onclick'=>'javascript:promptmessage(\''.$url.'\',\''.$name.'\')',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-check"></span>','#',$options);
                        }
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
