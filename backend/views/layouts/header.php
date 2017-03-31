<?php
use yii\helpers\Html;
use yii\helpers\Url;
use mdm\admin\components\MenuHelper;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">世界</span><span class="logo-lg">'.'后台管理'.'</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
<!--            <span class="sr-only">Toggle navigation</span>-->
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">管理员</span>
                        <sapn class="caret"></sapn>
                    </a>
                    <ul class="dropdown-menu" id="dropdown1" style="right:1">
                        <li>
                            <a href="<?=Url::to(['/site/logout']);?>" data-method="post">
                                <i class="glyphicon glyphicon-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
<!--                <li>-->
<!--                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--                </li>-->
            </ul>
        </div>

        <div class="navbar-header">
            <button class="btn btn-default  btn-sm navbar-toggle collapsed"
                    type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="caret"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse" role="navigation">
            <?php
                echo \yii\bootstrap\Nav::widget([
                    'items' => array_map(function($val){          //array_map()将用户自定义函数作用到数组中的每个值上，并返回用户自定义函数作用后的带有新值的数组。
                        $firstMenu = MenuHelper::getFirstMenu($val['items']);
                        $val['url'] = $firstMenu['url'];
                        unset($val['items']);
                        return $val;
                    }, MenuHelper::getAssignedMenu(Yii::$app->user->id)),
                    'options' => [
                        'class' => 'navbar-nav'
                    ],
                    'encodeLabels' => false,
                ])?>
        </div>
    </nav>
</header>
