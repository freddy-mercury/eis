<div class="form">

<?php
    /* @var $form CActiveForm */
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plan-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'min'); ?>
		<?php echo $form->textField($model,'min'); ?>
		<?php echo $form->error($model,'min'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max'); ?>
		<?php echo $form->textField($model,'max'); ?>
		<?php echo $form->error($model,'max'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'percent'); ?>
		<?php echo $form->textField($model,'percent') . $form->dropDownList($model, 'percent_per', Plan::getPercentPerOptions()); ?>
		<?php echo $form->error($model,'percent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'periodicity'); ?>
		<?php echo $form->textField($model,'periodicity') . $form->dropDownList($model, 'periodicity_value', Plan::getPeriodValues()); ?>
		<?php echo $form->error($model,'periodicity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term'); ?>
		<?php echo $form->textField($model,'term') . $form->dropDownList($model, 'term_value', Plan::getPeriodValues()); ?>
		<?php echo $form->error($model,'term'); ?>
	</div>

	<div class="row checkbox">
		<?php echo $form->checkBox($model,'compounding'); ?>
        <?php echo $form->labelEx($model,'compounding'); ?>
        <?php echo $form->error($model,'compounding'); ?>
	</div>

	<div class="row clear">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type', Plan::getTypesOptions()) ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row checkbox">
		<?php echo $form->checkBox($model,'monfri'); ?>
        <?php echo $form->labelEx($model,'monfri'); ?>
        <?php echo $form->error($model,'monfri'); ?>
	</div>

	<div class="row checkbox">
		<?php echo $form->checkBox($model,'principal_back'); ?>
        <?php echo $form->labelEx($model,'principal_back'); ?>
        <?php echo $form->error($model,'principal_back'); ?>
	</div>

	<div class="row clear buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->