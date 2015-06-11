<?php
$_m = isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id : '';
$_c = Yii::app()->controller->id;
$_a = Yii::app()->controller->action->id;

function _l($name, $icon)
{
    return '<i class="icon-'.$icon.'"></i><span class="menu-text">'.tt($name).'</span><b class="arrow icon-angle-down"></b>';
}

function _u($url)
{
    return Yii::app()->createUrl($url);
}

function _ch($controller, $action)
{
    return SH::checkServiceFor(MENU_ELEMENT_VISIBLE, $controller, $action);
}

function _i($name)
{
    return array('class'=> Yii::app()->controller->id==$name ? 'active open' : '');
}

$_l = array(
    'class' => 'dropdown-toggle',
);
$_l2 = '<i class="icon-double-angle-right"></i>';

$isStd   = Yii::app()->user->isStd;
$isTch   = Yii::app()->user->isTch;
$isAdmin = Yii::app()->user->isAdmin;


$this->widget('zii.widgets.CMenu', array(
    'encodeLabel' => false,
    'htmlOptions' => array(
        'id' => false,
        'class' => 'nav nav-list'
    ),
    'submenuHtmlOptions' => array(
        'class' => 'submenu',
    ),
    'items'=>array(

        array(
            'label' => _l('Меню', 'calendar'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=> array('class' => 'active open'),
            'items' => array(
                array(
                    'label'   => $_l2.tt('Академ. группы'),
                    'url'     => _u('/timeTable/group'),
                    'active'  => $_c=='timeTable' && $_a=='group',
                    'visible' => _ch('timeTable', 'group')
                ),
                array(
                    'label'   => $_l2.tt('Преподавателя'),
                    'url'     => _u('/timeTable/teacher'),
                    'active'  => $_c=='timeTable' && $_a=='teacher',
                    'visible' => _ch('timeTable', 'teacher')
                ),
                array(
                    'label'   => $_l2.tt('Студента'),
                    'url'     => _u('/timeTable/student'),
                    'active'  => $_c=='timeTable' && $_a=='student',
                    'visible' => _ch('timeTable', 'student')
                ),
                array(
                    'label'   => $_l2.tt('Телефонный справочник'),
                    'url'     => _u('/other/phones'),
                    'visible' => _ch('other', 'phones'),
                    'active'  => $_c=='other' && $_a=='phones'
                ),
            ),
            'visible' => _ch('timeTable', 'main')
        ),
    ),
));

