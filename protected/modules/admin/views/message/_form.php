<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
	'id' => 'message-form',
	'enableAjaxValidation' => false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'member_id'); ?>
		<?php echo $form->textField($model, 'member_id'); ?>
		<?php
		/*$member_options = array();
		foreach (Member::model()->findAll() as $member) {
			$member_options[$member->id] = $member->login;
		}
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'name' => 'member_id',
			'model' => $model,
			'source' => $member_options,
			// additional javascript options for the autocomplete plugin
			'options' => array(
				'minLength' => '2',
			),
			'htmlOptions' => array(
				'style' => 'height:20px;'
			),
		));*/
		?>
		<?php echo $form->error($model, 'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'subject'); ?>
		<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'text'); ?>
		<?php echo $form->textArea($model, 'text', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'text'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->