<?php
$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
	array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Member', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Member', 'url'=>array('admin')),
);
?>

<h1>View Member #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'access',
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
		'referral',
		'alert_profile',
		'alert_login',
		'alert_withdrawal',
		'date_registered',
		'hash',
	),
)); ?>
