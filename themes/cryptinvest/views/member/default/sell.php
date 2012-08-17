<h1><?php echo Yii::t('member', 'Sell currency') ?></h1>
<?php if (Yii::app()->user->hasFlash('sell')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('sell'); ?>
</div>

<?php endif; ?>
<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Sell currency'),
);
/* @var $this SellFormController */
/* @var $model SellForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sell-form-sell-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label><?php echo Yii::t('member', 'You have'); ?></label>
		<?php
		echo number_format(Yii::app()->user->model->rates_balance, 2) . ' ' . Yii::app()->params['rates']['name'];
		?>
	</div>

	<div class="row">
		<label><?php echo Yii::t('member', 'Buy rate'); ?></label>
		<?php
		$rates = Rates::getCurrentRates();
		echo '1 ' . Yii::app()->params['rates']['name'] . ' = $'. $rates['buy'];
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<label><?php echo Yii::t('member', 'You get'); ?></label>
		$<span id="SellForm_amount">0</span>
	</div>

	<script type="text/javascript" language="JavaScript">
		$('#SellForm_quantity').keyup(
			function() {
				var amount = parseFloat(parseFloat($(this).val()) *  <?= $rates['buy'] ?>).toFixed(2);
				$('#SellForm_amount').html(amount);
			}
		);
	</script>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
