<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">
    <div style="margin-top:-3%">
        <h3><?= Html::encode($this->title)?></h3>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="list-group">
        <div class="list-group-item" style="background-color:#f7f7f7;border-top:3px solid #3c8dbc">
            评论列表
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
//            'filterModel' => $searchModel,
            'summary'=>'',
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header'=>'序号',
                ],
                [
                    'attribute'=>'content',
                    'header'=>'评论内容',
                    'value'=>'beginning',
                ],
                [
                    'attribute'=>'novel_id',
                    'header'=>'标题',
                    'value'=>'novel.title',
                ],
                [
                    'attribute'=>'userid',
                    'header'=>'作者',
                    'value'=>'user.username',
                ],
                [
                    'attribute'=>'status',
                    'header'=>'状态',
                    'value'=>function($model)
                            {
                                return Yii::$app->params['C_status'][$model->status];
                            },
                    'contentOptions'=>function($model)
                                    {
                                        return ($model->status==1)?['class'=>'bg-danger']:[];
                                    },
                ],
                [
                    'attribute'=>'create_time',
                    'header'=>'发布时间',
                    'format'=>['date','php:Y-m-d H:i:s'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'操作',
                    'template'=>'{update}{delete}{approve}',
                    'buttons'=>[
                        'delete'=>function($url,$model,$key)
                        {
                            $url =Url::to(['comment/delete','id'=>$model->id]);
                            $name = '删除这条评论';
                            $options =[
                                'title'=>Yii::t('yii','删除'),
                                'aria-label'=>Yii::t('yii','删除'),
//                                'data-method'=>'post',
                                'onclick'=>'javascript:promptmessage(\''.$url.'\',\''.$name.'\')',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>','#',$options);
                        },
                        'approve'=>function($url,$model,$key)
                        {
                            $url =Url::to(['comment/approve','id'=>$model->id]);
                            $name = '通过这条评论';
                            $options =[
                                'title'=>Yii::t('yii','审核'),
                                'aria-label'=>Yii::t('yii','审核'),
//                                'data-confirm'=>Yii::t('yii','你确定通过这篇评论嘛'),
//                                'data-method'=>'post',
//                                'data-pjax'=>'0',
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
