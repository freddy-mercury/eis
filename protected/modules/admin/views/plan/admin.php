<?php
$this->breadcrumbs+=array(
	Yii::t('admin', 'Plans')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('plan-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Plans</h1>

<?php echo CHtml::link('Create plan', array('create')); ?> |
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'plan-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id',
		'name',
		'description',
        array(
            'header' => Yii::t('admin', 'Min &mdash; Max'),
	        'type' => 'html',
            'value' => function($data) {
				return $data->min . ' &mdash; ' . $data->max;
            }
        ),
		array(
			'header' => Yii::t('admin', 'Percents'),
			'value' => function($data) {
				return $data->percent . '% / ' . $data->percent_per;
			}
		),
		'periodicity',
		'term',
		//'compounding',
		'type',
		array(
			'header' => Yii::t('admin', 'Working days'),
			'value' => function($data) {
				return $data->monfri ? Yii::t('admin', 'yes') : Yii::t('admin', 'no');
			}
		),
		//'principal_back',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
