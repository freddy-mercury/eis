<?php
$this->breadcrumbs=array(
	'Plans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Create Plan', 'url'=>array('create')),
	array('label'=>'View Plan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>Update Plan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>