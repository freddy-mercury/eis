<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--/sprypay.tag.check:500ebbb7ce260/-->
	<?php $this->renderPartial('//layouts/head'); ?>
</head>

<body>

<div class="container" id="page">
	
	<div id="header">
        <? if (Yii::app()->language == 'en') { ?>
        <div id="logo" class="clearfix">
            <div style="float: stretch"><a href="/"><img src="<?= Yii::app()->theme->baseUrl ?>/banners/logo300.jpg"></a></div>
           
        </div>
        <? } else { ?>
		<div id="logo">
			<a href="/"><img src="<?= Yii::app()->theme->baseUrl ?>/banners/logo_full.jpg"></a>
		</div>
        <? } ?>
		<div id="language-selector" style="float:right; margin:5px;">
		    <?php $this->widget('application.components.widgets.LanguageSelector');	?>
	    </div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>Yii::t('global', 'Home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('global', 'Home'), 'url'=>array(Yii::app()->cms->createUrl('index'))),
				array('label'=>Yii::t('global', 'About'), 'url'=>array(Yii::app()->cms->createUrl('about'))),
				array('label'=>Yii::t('global', 'Rates'), 'url'=>array('/site/rates')),
				array('label'=>Yii::t('global', 'Register'), 'url'=>array('/site/register'),
					'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('member', 'Member area'), 'url'=>array('/member'),
					'visible'=>!Yii::app()->user->isGuest),
				array('label'=>Yii::t('global', 'Admin panel'), 'url'=>array('/admin'), 'visible'=>Yii::app()->user->isAdmin),
				array('label'=>Yii::t('global', 'Feedback'), 'url'=>array('/site/contact')),
				array('label'=>Yii::t('global', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('global', 'Logout ({username})',array('{username}'=>Yii::app()->user->name)), 'url'=>array('/site/logout'),
					'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php
        $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
            'homeLink'=>CHtml::link(Yii::app()->name, array('site/index')),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		<?php $this->renderPartial('//layouts/footer'); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
