<h1>
	<?php echo Yii::t('global', 'Transaction status') ?>
</h1>

<div class="flash-success"><?php echo Yii::t('global', 'Your payment has been successfully accepted!') ?></div>
<?php echo CHtml::link(Yii::t('global', 'Go to member area >>'), array('member/default/index')) ?>