<?php
$this->breadcrumbs += array(
    Yii::t('admin', 'Plans') => array('index'),
    Yii::t('admin', 'Create'),
);


?>

<h1>Create Plan</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>