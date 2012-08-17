<?php
/* @var $this ConfigController */
/* @var $model Config */

$this->breadcrumbs+=array(
    Yii::t('admin', 'Configs')=>array('index'),
    Yii::t('admin', 'Create'),
);
?>

<h1>Create Config</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>