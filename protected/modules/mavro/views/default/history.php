<?php
$this->breadcrumbs+=array(
	Yii::t('mavro', 'Operation\'s history')
);
?>
<h1><?php echo Yii::t('mavro', 'Operation\'s history')?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'member-grid',
	'dataProvider' => $model->mavro_stats(),
	'columns' => array(
		'id',
		array(
			'header' => Yii::t('admin', 'Type'),
			'value' => function($data) {
				$types = MavroTransaction::getTypes();
				return $types[$data->type];
			}
		),
		'amount',
		array(
			'header' => Yii::t('admin', 'Time'),
			'value' => function($data) {
				return date('d.m.Y H:i', $data->time);
			}
		),
	)));