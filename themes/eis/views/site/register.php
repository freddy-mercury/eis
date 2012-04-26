<?php
$this->breadcrumbs = array(
	'Site' => array('/site'),
	'Register',
);?>
<h1><?php echo Yii::t('global', 'Registration') ?></h1>

<?php if(Yii::app()->user->hasFlash('register')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('register'); ?>
</div>

<?php endif; ?>

<div class="form">

	<?php
	/* @var $form CActiveForm */
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'register-form',
		'enableClientValidation' => false,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	));
	/* @var $model Member */
	?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<table>
		<tr>
			<td>
				<fieldset>
					<legend><?php echo Yii::t('global', 'Security') ?></legend>
					<div class="row">
						<?php echo $form->labelEx($model, 'login'); ?>
						<?php echo $form->textField($model, 'login'); ?>
						<div class="hint">Minimum 3 symbols of digits and letters.</div>
						<?php echo $form->error($model, 'login'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'password'); ?>
						<?php echo $form->passwordField($model, 'password'); ?>
						<div class="hint">Minimum 6 symbols.</div>
						<?php echo $form->error($model, 'password'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'password_repeat'); ?>
						<?php echo $form->passwordField($model, 'password_repeat'); ?>
						<?php echo $form->error($model, 'password_repeat'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'email'); ?>
						<?php echo $form->textField($model, 'email'); ?>
						<div class="hint">Valid e-mail address.</div>
						<?php echo $form->error($model, 'email'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'login_pin'); ?>
						<?php
						$this->widget('CMaskedTextField', array(
							'model' => $model,
							'attribute' => 'login_pin',
							'mask' => '99999',
						));
						?>
						<div class="hint">5 digits.</div>
						<?php echo $form->error($model, 'login_pin'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'master_pin'); ?>
						<?php
						$this->widget('CMaskedTextField', array(
							'model' => $model,
							'attribute' => 'master_pin',
							'mask' => '999',
						));
						?>
						<div class="hint">3 digits.</div>
						<?php echo $form->error($model, 'master_pin'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_question'); ?>
						<?php
						$security_questions = SecurityQuestion::model()->findAll();
						$data = array();
						foreach($security_questions as $security_question)
							$data[$security_question->id] = $security_question->text;
						echo $form->dropDownList($model, 'security_question', $data);
						?>
						<?php echo $form->error($model, 'security_question'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_answer'); ?>
						<?php echo $form->textField($model, 'security_answer'); ?>
						<?php echo $form->error($model, 'security_answer'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'security_question2'); ?>
						<?php echo $form->dropDownList($model, 'security_question2', $data); ?>
						<div class="hint">Must differ to "Security question".</div>
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
							'mask' => '9999-99-99',
						));
						?>
						<div class="hint">Format: YYYY-MM-DD (Ex: <?php echo date('Y-m-d'); ?>)</div>
						<?php echo $form->error($model, 'birthdate'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'country'); ?>
						<?php
							$countries = Country::model()->findAll();
							$data = array();
							foreach($countries as $country)
								$data[$country->id] = $country->name;
							echo $form->dropDownList($model, 'country', $data);
						?>
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
						<?php echo $form->dropDownList($model, 'ecurrency', Yii::app()->ecurrency->getComponentsNames()); ?>
						<?php echo $form->error($model, 'ecurrency'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'ecurrency_purse'); ?>
						<?php echo $form->textField($model, 'ecurrency_purse'); ?>
						<div class="hint">USD purse.</div>
						<?php echo $form->error($model, 'ecurrency_purse'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'lang'); ?>
						<?php

							$messages_config = include(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'messages'
								. DIRECTORY_SEPARATOR . 'config.php');
							$languages = array_combine($messages_config['languages'], $messages_config['languages']);
							echo $form->dropDownList($model, 'lang', $languages);
						?>
						<?php echo $form->error($model, 'lang'); ?>
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