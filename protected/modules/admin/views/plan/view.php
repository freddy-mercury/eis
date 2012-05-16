<?php
$this->breadcrumbs+=array(
	'Plans'=>array('index'),
	$model->name,
);
?>

<h1>View Plan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'min',
		'max',
		'percent',
		'percent_per',
		'periodicity',
		'term',
		'compounding',
		'type',
		'monfri',
		'principal_back',
	),
)); ?>
