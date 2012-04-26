<?php
$this->breadcrumbs+=array(
	'Plans'=>array('index'),
	'Create',
);


?>

<h1>Create Plan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>