<?php
$this->breadcrumbs+=array(
	'Members'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Stats',
);

$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'member-grid',
	'dataProvider' => $model->mavro_stats(),
	'columns' => array(
		'id',
		array(
			'header' => Yii::t('mavro', 'Type'),
			'value' => function($data) {
				$types = MavroTransaction::getTypes();
				return $types[$data->type];
			}
		),
		'amount',
		array(
			'header' => Yii::t('mavro', 'Time'),
			'value' => function($data) {
				return date('d.m.Y H:i', $data->time);
			}
		),
		array(
			'header' => Yii::t('mavro', 'Status'),
			'value' => function($data) {
				$status = Yii::t('mavro', 'Processed');
				if ($data->status == 0) {
					$status = Yii::t('mavro', 'Pending');
				}
				return $status;
			}
		),
	)));
?>
