<?php
$this->breadcrumbs+=array(
	'Plans'=>array('index'),
	$model->name,
);
?>

<h1>View Plan #<?php echo $model->id; ?></h1>

<?php
/* @var $model Plan */
$period_values = Plan::getPeriodValues();
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'min',
		'max',
		'percent',
		'percent_per',
        array(
            'label' => Yii::t('admin', 'Periodicity'),
            'type' => 'html',
            'value' => $model->periodicity . ' ' . $period_values[$model->periodicity_value],
        ),
        array(
            'label' => Yii::t('admin', 'Term'),
            'type' => 'html',
            'value' => $model->term . ' ' . $period_values[$model->term_value],
        ),
		'compounding',
		'type',
		'monfri',
		'principal_back',
	),
)); ?>
