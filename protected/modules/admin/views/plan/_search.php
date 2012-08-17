<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'min'); ?>
		<?php echo $form->textField($model,'min'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max'); ?>
		<?php echo $form->textField($model,'max'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percent'); ?>
		<?php echo $form->textField($model,'percent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'percent_per'); ?>
		<?php echo $form->textField($model,'percent_per',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'periodicity'); ?>
		<?php echo $form->textField($model,'periodicity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term'); ?>
		<?php echo $form->textField($model,'term'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'compounding'); ?>
		<?php echo $form->textField($model,'compounding'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monfri'); ?>
		<?php echo $form->textField($model,'monfri'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'principal_back'); ?>
		<?php echo $form->textField($model,'principal_back'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->