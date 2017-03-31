<?php

use yii\helpers\Url;
use common\models\User;
use common\models\Novel;

/* @var $this yii\web\View */

$this->title = '欢迎页面';
?>
<div class="site-index">
    <div class="jumbotron">
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span>欢迎来到我的<strong>世界</strong>！
        </div>
        <div class="container">
            <div class="row">
<!--文章-->
                <div class="col-md-4 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo Novel::find()->count();?><sup style="font-size: 20px">篇</sup></h3>
                            <p>当前内容(文章)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="<?= Url::to(['novel/index'])?>" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<!--待审核-->
                <div class="col-md-4 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo Novel::find()->where(['status'=>'1'])->count();?><sup style="font-size: 20px">篇</sup></h3>
                            <p>待审内容(文章)</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="<?= Url::to(['novel/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
<!--用户-->
                <div class="col-md-4 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo User::find()->count();?><sup style="font-size: 20px">人</sup></h3>
                            <p>当前注册用户</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="<?= Url::to(['user/index']) ?>" class="small-box-footer">更多信息 <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="body-content">

    </div>
</div>
