<?php
$this->breadcrumbs+=array(
	Yii::t('member', 'Account summary'),
);
?>
<h1><?php echo Yii::t('member', 'Account summary'); ?></h1>

<?php $this->widget('cms.widgets.CmsBlock', array('name' => 'member_index')) ?>