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
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login_pin'); ?>
		<?php echo $form->textField($model,'login_pin',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'master_pin'); ?>
		<?php echo $form->textField($model,'master_pin',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_question'); ?>
		<?php echo $form->textField($model,'security_question'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_answer'); ?>
		<?php echo $form->textField($model,'security_answer',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_question2'); ?>
		<?php echo $form->textField($model,'security_question2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'security_answer2'); ?>
		<?php echo $form->textField($model,'security_answer2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ecurrency'); ?>
		<?php echo $form->textField($model,'ecurrency',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ecurrency_purse'); ?>
		<?php echo $form->textField($model,'ecurrency_purse',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'login_notify'); ?>
		<?php echo $form->textField($model,'login_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'profile_notify'); ?>
		<?php echo $form->textField($model,'profile_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'withdrawal_notify'); ?>
		<?php echo $form->textField($model,'withdrawal_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_limit'); ?>
		<?php echo $form->textField($model,'transaction_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'daily_limit'); ?>
		<?php echo $form->textField($model,'daily_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_limit'); ?>
		<?php echo $form->textField($model,'total_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lang'); ?>
		<?php echo $form->textField($model,'lang',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_registered'); ?>
		<?php echo $form->textField($model,'date_registered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monitor'); ?>
		<?php echo $form->textField($model,'monitor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->