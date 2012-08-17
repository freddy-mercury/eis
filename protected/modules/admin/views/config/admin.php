<?php
/* @var $this ConfigController */
/* @var $model Config */

$this->breadcrumbs+=array(
    Yii::t('admin', 'Configs')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('config-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Configs</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'config-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'key',
		'value',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
