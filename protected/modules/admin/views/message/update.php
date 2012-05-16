<?php
$this->breadcrumbs+=array(
	'Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update Message <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>