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
        'type',
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
                $period_values = Plan::getPeriodValues();
                switch ($data->percent_per) {
                    case 'periodicity':
                        $percent_per = $data->periodicity . ' ' . $period_values[$data->periodicity_value];
                        break;
                    case 'term':
                        $percent_per = $data->term . ' ' . $period_values[$data->term_value];
                        break;
                }
				return $data->percent . '% / ' . $percent_per;
			}
		),
        array(
            'header' => Yii::t('admin', 'Periodicity'),
            'value' => function($data) {
                $period_values = Plan::getPeriodValues();
                return $data->periodicity . ' ' . $period_values[$data->periodicity_value];
            }
        ),
        array(
            'header' => Yii::t('admin', 'Term'),
            'value' => function($data) {
                $period_values = Plan::getPeriodValues();
                return $data->term . ' ' . $period_values[$data->term_value];
            }
        ),
        array(
            'header' => Yii::t('admin', 'Compounding'),
            'value' => function($data) {
                return $data->compounding ? Yii::t('admin', 'yes') : Yii::t('admin', 'no');
            }
        ),
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
