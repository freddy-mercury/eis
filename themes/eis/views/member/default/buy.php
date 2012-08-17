<h1><?php echo Yii::t('member', 'Buy currency') ?></h1>


<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Buy currency'),
);
/* @var $this DefaultController */
/* @var $model BuyForm */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'buy-form-buy-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label><?php echo Yii::t('member', 'Sell rate'); ?></label>
		<?php
			$rates = Rates::getCurrentRates();
			echo '1 ' . Yii::app()->params['rates']['name'] . ' = $'. $rates['sell'];
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'quantity'); ?>
		<?php echo $form->textField($model, 'quantity'); ?>
		<?php echo $form->error($model, 'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'amount'); ?>
		<?php echo $form->textField($model, 'amount'); ?>
		<?php echo $form->error($model, 'amount'); ?>
	</div>

	<script type="text/javascript" language="JavaScript">
		$('#BuyForm_quantity').keyup(
			function() {
				var amount = parseFloat(parseFloat($(this).val()) * <?= $rates['sell']; ?>).toFixed(3);
				$('#BuyForm_amount').val(amount);
			}
		);
		$('#BuyForm_amount').keyup(
			function() {
				var quantity = parseFloat(parseFloat($(this).val()) / <?= $rates['sell']; ?>).toFixed(3);
				$('#BuyForm_quantity').val(quantity);
			}
		);
	</script>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->