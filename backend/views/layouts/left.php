<?php
use yii\helpers\Url;
use yii\widgets\Menu;

?>

<aside class="main-sidebar">
    <section class="sidebar">
<!--        --><?php
//        use mdm\admin\components\MenuHelper;
//        $callback = function($menu){
//            $data = json_decode($menu['data'], true);
//            $items = $menu['children'];
//            $return = ['label' => $menu['name'],'url' => [$menu['route']]];
//            //处理我们的配置
//            if ($data) {
//                isset($data['visible']) && $return['visible'] = $data['visible'];//visible
//                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];//icon
//                //other attribute e.g. class...
//                $return['options'] = $data;
//            }
//            //没配置图标的显示默认图标
//            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
//            $items && $return['items'] = $items;
//            return $return;
//        };
//        //这里我们对一开始写的菜单menu进行了优化
//        echo dmstr\widgets\Menu::widget( [
//            'options' => ['class' => 'sidebar-menu'],
//            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null, $callback),
//        ] );
//        ?>
        <?= \backend\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $leftMenuItems
            ]
        ) ?>
<!--        --><?//= Menu::widget(
//            [
//                'options' => ['class' => 'sidebar-menu'],
//                'items' => $leftMenuItems
//            ]
//        ) ?>
    </section>
</aside>
