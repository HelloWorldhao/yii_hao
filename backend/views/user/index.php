<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div style="margin-top:-3%">
        <h3><?= Html::encode($this->title)?></h3>
    </div>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="list-group">
        <div class="list-group-item" style="background-color:#f7f7f7;border-top:3px solid #3c8dbc">
            用户列表
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
                    'attribute'=>'username',
                    'header'=>'用户名',
                    'value'=>function($model){
                        return $model->username;
                    }
                ],
                [
                    'attribute'=>'pseudonym',
                    'header'=>'别名',
                    'value'=>function($model){
                        return $model->pseudonym;
                    }
                ],
                [
                    'attribute'=>'email',
                    'header'=>'Email',
                    'format'=>'email',
                ],
                [
                    'attribute'=>'status',
                    'header'=>'状态',
                    'value'=>function($model){
                        return Yii::$app->params['U_status'][$model->status];
                    }
                ],
                [
                    'attribute'=>'created_at',
                    'header'=>'创建时间',
                    'format'=>['date','php:Y-m-d H:i:s'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'操作',
                    'template'=>'{view}{update}{delete}{resetpwd}',
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
                        'resetpwd'=>function($url,$model,$key)
                                    {
                                        $options = [
                                            'title'=>Yii::t('yii','重置'),
                                            'aria-label'=>Yii::t('yii','重置密码'),
                                            'data-pjax'=>'0',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,$options);
                                    },
                    ],
//                    'options'=>['text-align'=>'center'],
                ],
            ],
        ]); ?>
    </div>
</div>
