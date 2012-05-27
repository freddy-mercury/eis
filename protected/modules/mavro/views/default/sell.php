<?php
$this->breadcrumbs+=array(
    Yii::t('mavro', 'Sell MAVRO')
);
?>

<h1><?= Yii::t('mavro', 'Sell MAVRO') ?></h1>

<?php if (Yii::app()->user->hasFlash('mavro_sell_request')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('mavro_sell_request'); ?>
</div>

<?php endif; ?>

<div align="center">
	<div class="form" style="width: 450px; border:1px solid green">
		<?php
		/* @var $form  CActiveForm */
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'mavro-buy-form',
			'enableAjaxValidation'=>false,
		)); ?>
		<table>
			<tr>
				<th><?php echo Yii::t('mavro', 'Sell rate (roubles)'); ?></th>
				<td>
					<?php
					$rates = Yii::app()->mavro->getTodayRates();
					echo $rates[1];
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo Yii::t('mavro', 'You have'); ?></th>
				<td>
					<?php
					echo Yii::app()->user->model->getMavroBalance();
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form->label($model,'amount'); ?></th>
				<td class="row">
					<?php echo $form->textField($model,'amount', array(
					'id' => 'amount',
					'onkeyup' => '$("#sum").html(parseFloat('.$rates[1].'*this.value,3).toFixed(2));',
					'onchange' => '$("#sum").html(parseFloat('.$rates[1].'*this.value,3).toFixed(2));',
					'onblur' => '$("#sum").html(parseFloat('.$rates[1].'*this.value,3).toFixed(2));',
					'autocomplete' => 'off',
				)); ?>
					<?php echo $form->error($model,'amount'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo Yii::t('mavro', 'Total amount (roubles)'); ?></th>
				<td>
					<span id="sum"><?= round($model->amount*$rates[1], 2) ?></span>
				</td>
			</tr>
			<tr>
				<td>
					<b><?php echo $form->label($model,'payment_info'); ?></b><br>
					<div class="hint"><?php echo Yii::t('mavro', '<span class="red">Attention!</span> In this field you must specify the account
					details (bank account, an account in a payment system, credit card number, etc.), on which the funds
					will be transferred.') ?></div>
				</td>
				<td>
					<?php echo $form->textArea($model, 'payment_info', array('rows' => 10, 'cols' => 30)); ?>
					<?php echo $form->error($model,'payment_info'); ?>
				</td>
			</tr>
		</table>
		<div class="row buttons">
			<?php echo CHtml::submitButton(Yii::t('global', 'Submit')); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>