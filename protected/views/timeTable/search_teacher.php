<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */
$this->pageHeader=tt('Расписание преподавателя: Поиск');
$this->breadcrumbs=array(
    tt('Расписание'),
);
$url = Yii::app()->baseUrl.'/images/keyboard.png';
Yii::app()->clientScript->registerScript('params', <<<JS
    var imageUrl = '{$url}';
     $(document).ready(function(){
        VKI_imageURI = imageUrl;
    });
    
JS
 , CClientScript::POS_HEAD
);	
$teachers = $model->getSearchTeachers($model->p3);
$this->renderPartial('search_teacher_form', array(
    'teacher' => $model,
));

$timTable=new TimeTableForm;
$form1=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('style'=>'display:none'),
	'method'=>'post',
	'action'=> array('timeTable/teacher'),
));
?>
	<?php echo $form1->hiddenField($timTable,'filial'); ?>
	<?php echo $form1->hiddenField($timTable,'chair'); ?>
	<?php echo $form1->hiddenField($timTable,'teacher'); ?>
	<?php
$this->endWidget();

$filial=false;
$filials = Ks::model()->findAll();
if (count($filials) > 1) {
	$filial=true;
}

if(!empty($teachers))
{
	echo '<div class="table-responsive">
	<table class="table table-striped table table-bordered table-hover table-condensed">';
	$i=1;
	echo '<thead>
        <tr>
          <th>№</th>
          <th>'.tt('Ф.И.О.').'</th>
          <th>'.$timTable->getAttributeLabel('chair').'</th>';
		  if($filial)
			echo '<th>'.$timTable->getAttributeLabel('filial').'</th>';
          echo '<th></th>
        </tr>
      </thead>
	  <tbody>';
	foreach($teachers as $teacher)
	{
		echo '<tr>
          <th scope="row">'.$i.'</th>
          <td>'.SH::getShortName($teacher['p3'], $teacher['p4'], $teacher['p5']).'</td>
          <td>'.$teacher['k3'].'</td>';
		  if($filial)
			echo '<td>'.$teacher['ks3'].'</td>';
          echo '<td><a class="btn-check btn btn-small btn-success" href="#" data-ks1="'.$teacher['ks1'].'" data-p1="'.$teacher['p1'].'" data-k1="'.$teacher['k1'].'"><i class="icon-check"> '.tt('Выбрать').'</i></td>
        </tr>';
		$i++;
	}
	echo '</tbody>
			</table>
			</div>';
}
else{
	$error=tt('Нет результатов');
	if(empty($model->p3))
		$error=tt('Введите запрос');
?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong><?=tt('Внимание!')?></strong> <?=$error?>
	</div>
<?php
}

Yii::app()->clientScript->registerScript('check', "
    $(document).on('click', '.btn-search',function(event) {
        if($('#P_p3').val()=='')
		{
			event.preventDefault();
		}
    });
	
	$(document).on('click', '.btn-check',function(event) {
		var k1=$(this).data('k1');
		var ks1=$(this).data('ks1');
		var p1=$(this).data('p1');
		$('#TimeTableForm_filial').val(ks1);
		$('#TimeTableForm_chair').val(k1);
		$('#TimeTableForm_teacher').val(p1);
        $('#timeTable-form').submit();
    });
");
	