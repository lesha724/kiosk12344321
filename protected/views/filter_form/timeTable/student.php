<?php
/**
 *
 * @var TimeTableForm || FilterForm $model
 * @var CActiveForm $form
 */
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';
    $filials = Ks::getListDataForKsFilter();
    if (count($filials) > 1) {
        $html .= '<div class="span3 ace-select">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $options);
        $html .= '</div>';
    }else{
        $model->filial = key($filials);
    }

    $faculties = CHtml::listData(F::model()->getFacultiesFor($model->filial), 'f1', 'f3');
    if(count($faculties)==1)
    $model->faculty = key($faculties);
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'faculty');
    $html .= $form->dropDownList($model, 'faculty', $faculties, $options);
    $html .= '</div>';


    $courses = Sp::model()->getCoursesFor($model->faculty);
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'course');
    $html .= $form->dropDownList($model, 'course', $courses, $options);
    $html .= '</div>';


    $groups = CHtml::listData(Gr::model()->getGroupsForTimeTable($model->faculty, $model->course), 'gr1', 'name');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'group');
    $html .= $form->dropDownList($model, 'group', $groups, $options);
    $html .= '</div>';


    $students = CHtml::listData(St::model()->getStudentsOfGroup($model->group), 'st1', 'name');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'student');
    $html .= $form->dropDownList($model, 'student', $students, $options);
    $html .= '</div>';
    $html .= '</fieldset>';

    $html .= '<fieldset style="margin-top:1%;">';


    if ($showDateRangePicker) {
        $html .= $this->renderPartial('_date_interval', array(
            'date1' => $model->date1,
            'date2' => $model->date2,
            'r11'   => $model->r11,
        ), true);

        $html .= $form->hiddenField($model, 'date1');
        $html .= $form->hiddenField($model, 'date2');

        $html .= '</fieldset>';
    }

    $html .= '</div>';

    echo $html;

$this->endWidget();