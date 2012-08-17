<h1><?php echo Yii::t('global', 'Buy/Sell history'); ?></h1>
<?php
/* @var $model Member */
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'member-grid',
    'dataProvider' => $model->rates_stats(),
    'columns' => array(
        'id',
        array(
            'header' => Yii::t('global', 'Type'),
            'value' => function($data) {
                $types = RatesTransaction::getTypes();
                return $types[$data->type];
            }
        ),
        'quantity',
        array(
            'header' => Yii::t('gloabl', 'Time'),
            'value' => function($data) {
                return date('d.m.Y H:i', $data->time);
            }
        ),
	    array(
		    'header' => Yii::t('global', 'Batch'),
		    'value' => function($data) {
			    if ($data->status == 1 && $data->type == 'sell') {
				    return Yii::t('global', 'Pending');
			    }
			    return $data->batch;
			}
	    ),

    )));