<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'htmlOptions' => array('class' => 'form-inline noprint'),
	'method'=>'post',
	'action'=> array('timeTable/searchStudent'),
));
?>
	<?php echo $form->textField($student,'st2',array('class'=>'keyboardInput','size'=>60,'maxlength'=>255)); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'icon'=>'search',
		'label'=>tt('Поиск'),
		'htmlOptions'=>array(
			'class'=>'btn-small'
		)
	)); ?>
	<?php
$this->endWidget();
