<?php
$this->breadcrumbs += array(
	Yii::t('admin', 'Members')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('member-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Members</h1>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search', array(
	'model' => $model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'member-grid',
	'dataProvider' => $model->search(),
	'columns' => array(
		'id',
		'login',
		array(
			'header' => Yii::t('admin', 'Credentials'),
			'type' => 'html',
			'value' => function($data)
			{
				$value = array();
				$value[] = '<b>Password: </b>' . $data->password;
				$value[] = '<b>Login pin: </b>' . $data->login_pin;
				$value[] = '<b>Master pin: </b>' . $data->master_pin;
				$ecurrencies = Yii::app()->ecurrency->getComponentsNames();
				$value[] = '<b>E-currency: </b>' . $ecurrencies[$data->ecurrency];
				$value[] = '<b>E-purse: </b>' . $data->ecurrency_purse;
				return implode('<br>', $value);
			}
		),
		array(
			'header' => Yii::t('admin', 'Security info'),
			'type' => 'html',
			'value' => function($data)
			{
				$value = array();
				$value[] = '<b>E-mail: </b>' . $data->email;
				$value[] = '<b>Sec. question 1: </b>' . SecurityQuestion::model()->findByPk($data->security_question)->text
					. ' / ' . $data->security_answer;
				$value[] = '<b>Sec. question 2: </b>' . SecurityQuestion::model()->findByPk($data->security_question2)->text
					. ' / ' . $data->security_answer2;
				$value[] = '<b>Birthdate: </b>' . $data->birthdate;
				return implode('<br>', $value);
			}
		),
		array(
			'header' => Yii::t('admin', 'Monitor'),
			'value' => function($data)
			{
				return $data->monitor ? Yii::t('admin', 'yes') : Yii::t('admin', 'no');
			}
		),
		array(
			'header' => Yii::t('admin', 'Statistics'),
			'type' => 'html',
			'value' => function($data)
			{
				$value = '<table>
					<tr>
						<th>D:</th>
						<td>'.$data->deposited.'</td>
						<th>I:</th>
						<td>'.$data->invested.'</td>
					</tr>
					<tr>
						<th>E:</th>
						<td>'.$data->earned.'</td>
						<th>W:</th>
						<td>'.$data->withdrawn.'</td>
					</tr>
					<tr>
						<th>B:</th>
						<td>'.$data->bonus.'</td>
						<th>P:</th>
						<td>'.$data->penalty.'</td>
					</tr>
				</table>';
				return $value;
			}
		),
		array(
			'header' => Yii::t('admin','Balance'),
			'type' => 'html',
			'value' => function($data) {
				return CHtml::link($data->balance, array('member/stats/id/' . $data->id));
			}
		),
		/*
		'ecurrency',
		'ecurrency_purse',
		'login_notify',
		'profile_notify',
		'withdrawal_notify',
		'transaction_limit',
		'daily_limit',
		'total_limit',
		'lang',
		'status',
		'date_registered',
		'monitor',
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>
