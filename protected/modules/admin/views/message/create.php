<?php
$this->breadcrumbs+=array(
	Yii::t('admin', 'Messages')=>array('index'),
	Yii::t('admin', 'Create'),
);

?>

<h1>Create Message</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>