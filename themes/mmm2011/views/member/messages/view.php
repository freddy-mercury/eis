<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Messages') => array('/member/messages/index'),
	$model->id
);
?>
<h1><?php echo $model->subject; ?></h1>
<?php
echo nl2br($model->text);