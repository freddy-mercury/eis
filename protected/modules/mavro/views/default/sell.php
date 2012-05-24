<?php
$this->breadcrumbs+=array(
    Yii::t('mavro', 'Sell MAVRO')
);
?>

<h1><?= Yii::t('mavro', 'Sell MAVRO') ?></h1>

<div align="center">
	<div class="form" style="width: 400px; border:1px solid green">
		<?php
		/* @var $form  CActiveForm */
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'mavro-buy-form',
			'enableAjaxValidation'=>false,
		)); ?>
		<table>
			<tr>
				<th><?php echo Yii::t('mavro', 'Sell rate'); ?></th>
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
					echo Yii::app()->user->model->mavro;
					?>
				</td>
			</tr>
			<tr>
				<th><?php echo $form->label($model,'amount'); ?></th>
				<td class="row">
					<?php echo $form->textField($model,'amount', array(
					'id' => 'amount',
					'onkeyup' => '$("#sum").html('.$rates[1].'*this.value);'
				)); ?>
					<?php echo $form->error($model,'amount'); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo Yii::t('mavro', 'Total sum'); ?></th>
				<td>
					<span id="sum"></span>
				</td>
			</tr>
		</table>
		<div class="row buttons">
			<?php echo CHtml::submitButton('Sell'); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>