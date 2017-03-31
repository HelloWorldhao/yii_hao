<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '入口';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

$cssString=".login-page{ background-image: Url(../resource/images/background2.jpg);background-size:100% }.login-box{width:380px;margin:10% auto} .login-logo a{ color:white;
}";
$this->registerCss($cssString);
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b></b>世界</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登录</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => '请输入邮箱/手机号']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => '密码']) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe',['labelOptions'=>['label'=>'下次自动登录']])->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4" style="margin-top:10px">
                <?= Html::a('忘记密码',\yii\helpers\Url::to(['login'],[]))?>
            </div>
            <!-- /.col -->
        </div>
        <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
