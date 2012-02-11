<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'member-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login_pin'); ?>
		<?php echo $form->textField($model,'login_pin',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'login_pin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'master_pin'); ?>
		<?php echo $form->textField($model,'master_pin',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'master_pin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_question'); ?>
		<?php echo $form->textField($model,'security_question'); ?>
		<?php echo $form->error($model,'security_question'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_answer'); ?>
		<?php echo $form->textField($model,'security_answer',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'security_answer'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_question2'); ?>
		<?php echo $form->textField($model,'security_question2'); ?>
		<?php echo $form->error($model,'security_question2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'security_answer2'); ?>
		<?php echo $form->textField($model,'security_answer2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'security_answer2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'birthdate'); ?>
		<?php echo $form->textField($model,'birthdate'); ?>
		<?php echo $form->error($model,'birthdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ecurrency'); ?>
		<?php echo $form->textField($model,'ecurrency',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'ecurrency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ecurrency_purse'); ?>
		<?php echo $form->textField($model,'ecurrency_purse',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'ecurrency_purse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'login_notify'); ?>
		<?php echo $form->textField($model,'login_notify'); ?>
		<?php echo $form->error($model,'login_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profile_notify'); ?>
		<?php echo $form->textField($model,'profile_notify'); ?>
		<?php echo $form->error($model,'profile_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'withdrawal_notify'); ?>
		<?php echo $form->textField($model,'withdrawal_notify'); ?>
		<?php echo $form->error($model,'withdrawal_notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'transaction_limit'); ?>
		<?php echo $form->textField($model,'transaction_limit'); ?>
		<?php echo $form->error($model,'transaction_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'daily_limit'); ?>
		<?php echo $form->textField($model,'daily_limit'); ?>
		<?php echo $form->error($model,'daily_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_limit'); ?>
		<?php echo $form->textField($model,'total_limit'); ?>
		<?php echo $form->error($model,'total_limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->textField($model,'lang',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_registered'); ?>
		<?php echo $form->textField($model,'date_registered'); ?>
		<?php echo $form->error($model,'date_registered'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monitor'); ?>
		<?php echo $form->textField($model,'monitor'); ?>
		<?php echo $form->error($model,'monitor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->