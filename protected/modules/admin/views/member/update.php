<?php
$this->breadcrumbs+=array(
	'Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Member <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>