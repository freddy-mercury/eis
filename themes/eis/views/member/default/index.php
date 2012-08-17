<?php
$this->breadcrumbs += array(
	Yii::t('member', 'Account summary'),
);
$rates = Rates::getCurrentRates();
?>
<h1><?php echo Yii::t('member', 'Account summary'); ?></h1>
<h4>
	<p>
		<?= Yii::t('member', 'Hi, <b>{login}</b>!', array('{login}' => Yii::app()->user->model->login))?>
	</p>

	<p>
		<?= Yii::t('member', 'Your balance: <b>{rates_balance} {currency_name}</b>.',
		array(
			'{rates_balance}' => Yii::app()->user->model->rates_balance,
			'{currency_name}' => Yii::app()->params['rates']['name']
		))?>
	</p>

	<p>
		<?= Yii::t('member', 'Today\'s rates'); ?>
	<ul style="list-style: none">
		<li><?= Yii::t('member', 'We buy at ${buy_rate} / 1{currency_name}',
			array(
				'{buy_rate}' => $rates['buy'],
				'{currency_name}' => Yii::app()->params['rates']['name']
			))?>
		</li>
		<li><?= Yii::t('member', 'We sell at ${sell_rate} / 1{currency_name}',
			array(
				'{sell_rate}' => $rates['sell'],
				'{currency_name}' => Yii::app()->params['rates']['name']
			))?>
		</li>
	</ul>
	</p>
</h4>