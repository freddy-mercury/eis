<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Account summary'),
);
?>
<h1><?php echo Yii::t('member', 'Account summary'); ?></h1>

<?php
if (Yii::app()->mavro->enabled) {
	?>
	<?php echo Yii::t('mavro', 'You have {mavro} MAVRO', array('{mavro}' => Yii::app()->user->model->getMavroBalance())) ?>
	<?php
}
?>