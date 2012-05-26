<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Edit profile'),
);
?>
<h1><?php echo Yii::t('member', 'Edit profile'); ?></h1>
<?php if (Yii::app()->user->hasFlash('profile')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('profile'); ?>
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
						<?php echo $form->labelEx($model, 'password'); ?>
						<?php echo $form->passwordField($model, 'password', array('autocomplete' => 'off')); ?>
						<div class="hint">Minimum 6 symbols.</div>
						<?php echo $form->error($model, 'password'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'password_repeat'); ?>
						<?php echo $form->passwordField($model, 'password_repeat', array('autocomplete' => 'off')); ?>
						<?php echo $form->error($model, 'password_repeat'); ?>
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
				</fieldset>
			</td>
			<td>
				<fieldset>
					<legend>E-currency and other</legend>
					<?php
						$ecurrencies = Yii::app()->ecurrency->getComponentsNames();
						if ($ecurrencies) {
					?>
					<div class="row">
						<?php echo $form->labelEx($model, 'ecurrency'); ?>
						<?php
						echo $form->dropDownList($model, 'ecurrency', $ecurrencies,
							array('disabled' => 'disabled'));
						?>
						<?php echo $form->error($model, 'ecurrency'); ?>
					</div>
					<div class="row">
						<?php echo $form->labelEx($model, 'ecurrency_purse'); ?>
						<?php echo $form->textField($model, 'ecurrency_purse'); ?>
						<div class="hint">USD purse.</div>
						<?php echo $form->error($model, 'ecurrency_purse'); ?>
					</div>
					<?php } ?>
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
			<td>
				<fieldset>
					<legend>Notifications</legend>
					<div class="row checkbox">
						<?php echo $form->checkBox($model, 'login_notify') ?>
						<?php echo $form->labelEx($model, 'login_notify'); ?>
						<?php echo $form->error($model, 'login_notify'); ?>
					</div>
					<div class="row checkbox">
						<?php echo $form->checkBox($model, 'profile_notify') ?>
						<?php echo $form->labelEx($model, 'profile_notify'); ?>
						<?php echo $form->error($model, 'profile_notify'); ?>
					</div>
					<div class="row checkbox">
						<?php echo $form->checkBox($model, 'withdrawal_notify') ?>
						<?php echo $form->labelEx($model, 'withdrawal_notify'); ?>
						<?php echo $form->error($model, 'withdrawal_notify'); ?>
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
