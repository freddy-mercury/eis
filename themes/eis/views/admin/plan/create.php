<?php
$this->breadcrumbs=array(
	'Plans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Plan', 'url'=>array('index')),
	array('label'=>'Manage Plan', 'url'=>array('admin')),
);
?>

<h1>Create Plan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>