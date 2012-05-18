<?php
$this->breadcrumbs+=array(
    Yii::t('mavro', 'Sell MAVRO')
);
echo '<pre>';
var_dump(Yii::app()->mavro->getTodayRates());
echo '</pre>';