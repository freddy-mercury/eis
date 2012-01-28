<?php
$this->breadcrumbs = array(
	'Site' => array('/site'),
	'Register',
);?>
<h1><?php echo Yii::t('global', 'Registration') ?></h1>

<div class="form">

	<?php
	/* @var $form CActiveForm */
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'register-form',
		'enableClientValidation' => false,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<table>
		<tr>
			<td>
				<fieldset>
					<legend><?php echo Yii::t('global', 'Security') ?></legend>
					<div class="row">
						<?php echo $form->labelEx($model, 'login'); ?>
						<?php echo $form->textField($model, 'login'); ?>
						<?php echo $form->error($model, 'login'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'password'); ?>
						<?php echo $form->textField($model, 'password'); ?>
						<?php echo $form->error($model, 'password'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'password_repeat'); ?>
						<?php echo $form->textField($model, 'password_repeat'); ?>
						<?php echo $form->error($model, 'password_repeat'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'email'); ?>
						<?php echo $form->textField($model, 'email'); ?>
						<?php echo $form->error($model, 'email'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'login_pin'); ?>
						<?php echo $form->textField($model, 'login_pin'); ?>
						<?php echo $form->error($model, 'login_pin'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'master_pin'); ?>
						<?php echo $form->textField($model, 'master_pin'); ?>
						<?php echo $form->error($model, 'master_pin'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_question'); ?>
						<?php echo $form->textField($model, 'security_question'); ?>
						<?php echo $form->error($model, 'security_question'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_answer'); ?>
						<?php echo $form->textField($model, 'security_answer'); ?>
						<?php echo $form->error($model, 'security_answer'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_question2'); ?>
						<?php echo $form->textField($model, 'security_question2'); ?>
						<?php echo $form->error($model, 'security_question2'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_answer2'); ?>
						<?php echo $form->textField($model, 'security_answer2'); ?>
						<?php echo $form->error($model, 'security_answer2'); ?>
					</div>

				</fieldset>
			</td>
			<td>
				<fieldset>
					<legend>Personal</legend>
					<div class="row">
						<?php echo $form->labelEx($model, 'firstname'); ?>
						<?php echo $form->textField($model, 'firstname'); ?>
						<?php echo $form->error($model, 'firstname'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'lastname'); ?>
						<?php echo $form->textField($model, 'lastname'); ?>
						<?php echo $form->error($model, 'lastname'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'birthdate'); ?>
						<?php
						$this->widget('CMaskedTextField', array(
							'model' => $model,
							'attribute' => 'birthdate',
							'mask' => '99/99/9999',
						));
						?>
						<?php echo $form->error($model, 'birthdate'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'country'); ?>
						<?php echo $form->textField($model, 'country'); ?>
						<?php echo $form->error($model, 'country'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'city'); ?>
						<?php echo $form->textField($model, 'city'); ?>
						<?php echo $form->error($model, 'city'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'zip'); ?>
						<?php echo $form->textField($model, 'zip'); ?>
						<?php echo $form->error($model, 'zip'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'address'); ?>
						<?php echo $form->textArea($model, 'address', array('rows'=>5, 'cols'=>30)) ?>
						<?php echo $form->error($model, 'address'); ?>
					</div>
				</fieldset>
			</td>
			<td>
				<fieldset>
					<legend>E-currency and other</legend>
					<div class="row">
						<?php echo $form->labelEx($model, 'ecurrency'); ?>
						<?php echo $form->textField($model, 'ecurrency'); ?>
						<?php echo $form->error($model, 'ecurrency'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'ecurrency_purse'); ?>
						<?php echo $form->textField($model, 'ecurrency_purse'); ?>
						<?php echo $form->error($model, 'ecurrency_purse'); ?>
					</div>
				</fieldset>
			</td>
		</tr>
	</table>


	<?php if (CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model, 'verifyCode'); ?>
		<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model, 'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
			<br/>Letters are not case-sensitive.
		</div>
		<?php echo $form->error($model, 'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->