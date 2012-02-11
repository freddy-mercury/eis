<h1><?php echo Yii::t('global', 'Messages') ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => Yii::app()->user->model->messages,
		'columns' => array(
			'id',
			'subject',
//			array(
//				'name' => Yii::t('global', 'Date'),
//				'value' => $data->stamp
//			),
			array(            // display a column with "view", "update" and "delete" buttons
				'class'=>'CButtonColumn',
			),

		)
	)
);
?>