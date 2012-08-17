<h1><?php echo Yii::t('global', 'History'); ?></h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'member-grid',
    'dataProvider' => $model->stats(),
    'columns' => array(
        'id',
        array(
            'header' => Yii::t('admin', 'Type'),
            'value' => function($data) {
                $types = Transaction::getTypes();
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
        'batch',
    )));