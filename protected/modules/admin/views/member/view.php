<?php
$this->breadcrumbs+=array(
	'Members'=>array('index'),
	$model->id,
);
?>

<h1>View Member #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'password',
		'login_pin',
		'master_pin',
		'email',
		'security_question',
		'security_answer',
		'security_question2',
		'security_answer2',
		'firstname',
		'lastname',
		'birthdate',
		'country',
		'city',
		'zip',
		'address',
		'ecurrency',
		'ecurrency_purse',
		'login_notify',
		'profile_notify',
		'withdrawal_notify',
		'transaction_limit',
		'daily_limit',
		'total_limit',
		'lang',
		'status',
		'date_registered',
		'monitor',
	),
)); ?>
