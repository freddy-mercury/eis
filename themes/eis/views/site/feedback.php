<?php
$this->breadcrumbs=array(
	Yii::t('feedback','Feedback'),
);
?>

<h1><?= Yii::t('feedback','Feedback') ?></h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
<?= Yii::t('feedback','If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.') ?>
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	//'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">
        <?= Yii::t('global','Fields with <span class="required">*</span> are required.')?>
    </p>

    <div style="float:right; margin-right: 300px">
        <table>
            <!--tr>
                <td><img src="<?= Yii::app()->theme->baseUrl ?>/banners/skype.gif"></td>
                <td class="bold large"><a href="skype:mmm2011-auto.com?call">mmm2011-auto.com</a></td>
            </tr-->
            <tr>
                <td><img src="<?= Yii::app()->theme->baseUrl ?>/banners/email.gif"></td>
                <td class="bold large"><a href="mailto:support@cryptinvest.com">support@cryptinvest.com</a></td>
            </tr>
        </table>

    </div>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint"><?= Yii::t('global','Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.') ?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('global','Submit')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
