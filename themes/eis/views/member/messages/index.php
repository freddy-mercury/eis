<h1><?php echo Yii::t('global', 'Messages') ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider' => $messages_data_provider,
		'rowCssClassExpression' => function($row, $data)
		{
			$css_class = ($row+2) % 2 == 0 ? 'odd' : 'even';
		    return $css_class . ($data->is_read ? '' : ' bold');
		},
		'columns' => array(
			'id',
			'subject',
			array(
				'name' => 'text',
				'value' => function($data)
				{
					return strlen($data->text) > 50 ? substr($data->text, 0, 50) . '...' : $data->text;
				}
			),
			array(
				'header' => Yii::t('global', 'Date'),
				'type' => 'html',
				'value' => function($data)
				{
					return date('d-m-Y H:i', $data->stamp);
				}
			),
			array(
				'header' => Yii::t('global', 'Status'),
				'value' => function($data)
				{
					return $data->is_read ? '' : 'New';
				}
			),
			array( // display a column with "view", "update" and "delete" buttons
				'class' => 'CButtonColumn',
				'buttons' => array(
					'update' => array(
						'visible' => 'false'
					),
				),
			),

		)
	)
);
?>