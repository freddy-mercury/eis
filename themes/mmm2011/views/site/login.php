<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	Yii::t('global','Login'),
);
?>

<h1><?= Yii::t('global','Login') ?></h1>

<p><?= Yii::t('login','Please fill out the following form with your login credentials:')?></p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	//'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <p class="note">
        <?= Yii::t('global','Fields with <span class="required">*</span> are required.')?>
    </p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?><br>
        <span class="small"><a href="/site/contact"><?= Yii::t('login','Forgot password?')?></a></span>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'login_pin'); ?>
		<?php $this->widget('ext.widgets.PinInput.PinInput', array(
			'model'=>$model,
			'attribute'=>'login_pin',
			'htmlOptions'=>array(
				'style'=>'width: 82px;'
			)
		)); ?>
		<?php echo $form->error($model,'login_pin'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

    <?php if (CCaptcha::checkRequirements()): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'verifyCode'); ?>
        <div>
            <?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model, 'verifyCode'); ?>
        </div>
        <div class="hint">
            <?= Yii::t('global','Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.') ?>
        </div>
        <?php echo $form->error($model, 'verifyCode'); ?>
    </div>
    <?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('global','Submit')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
