<?php
$this->breadcrumbs += array(
	Yii::t('admin', 'Messages')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('message-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Messages</h1>

<?php echo CHtml::link('Create message', array('create')); ?> |
<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'message-grid',
	'dataProvider' => $model->search(),
	'columns' => array(
		'id',
		array(
			'header' => Yii::t('admin', 'To'),
			'value' => function($data)
			{
				return $data->member->login;
			}
		),
		'subject',
		array(
			'header' => Yii::t('admin', 'Time'),
			'value' => function($data)
			{
				return date('d.m.Y H:i', $data->stamp);
			}
		),
		array(
			'header' => Yii::t('admin', 'Is read'),
			'value' => function($data)
			{
				return $data->is_read ? Yii::t('admin', 'yes') : Yii::t('admin', 'no');
			}
		),
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>
