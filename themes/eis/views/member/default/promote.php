<?php
$referral_link = Yii::app()->getBaseUrl(true)
	. Yii::app()->urlManager->createUrl('site/register', array('referral' => Yii::app()->user->model->login));
$banners_path = Yii::app()->getBaseUrl(true) . Yii::app()->theme->baseUrl . '/banners/';
?>
<h1><?php echo Yii::t('global', 'Promote yourself') ?></h1>
<p>
	<?php echo Yii::t('global', 'Invite your friends and get referral commission to your account!'); ?>
</p>
<p>
	<?php echo Yii::t('global', 'You referral link'); ?>:

	<a href="<?php echo $referral_link ?>">
		<?php echo $referral_link ?>
	</a>
</p>
<p><b>HTML Code 468x60:</b></p>
<p><img src="<?php echo $banners_path ?>468x60.gif" style="border:1px solid #cccccc"></p>
<p><?php echo CHtml::textArea('img468x60', '<a href="' . $referral_link
	. '"><img src="' . $banners_path . '468x60.gif" border="0"></a>', array('rows' => 3, 'cols' => 70)) ?></p>
<p><b>BB Code:</b></p>
<p><?php echo CHtml::textArea('bb468x60', '[url=' . $referral_link . '][img]'
	. $banners_path . '468x60.gif[/img][/url]', array('rows' => 3, 'cols' => 70)) ?></p>

<p><b>HTML Code 728x90:</b></p>
<p><img src="<?php echo $banners_path ?>728x90.gif" style="border:1px solid #cccccc"></p>
<p><?php echo CHtml::textArea('img728x90', '<a href="' . $referral_link
	.'"><img src="' . $banners_path . '728x90.gif" border="0"></a>', array('rows' => 3, 'cols' => 70)) ?></p>
<p><b>BB Code:</b></p>
<p><?php echo CHtml::textArea('bb728x90', '[url=' . $referral_link . '][img]'
	. $banners_path . '728x90.gif[/img][/url]', array('rows' => 3, 'cols' => 70)) ?></p>