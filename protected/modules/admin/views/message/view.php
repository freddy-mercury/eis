<?php
$this->breadcrumbs+=array(
	'Messages'=>array('index'),
	$model->id,
);

?>

<h1>View Message #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'member_id',
		'subject',
		'text',
		'stamp',
		'is_read',
	),
)); ?>
