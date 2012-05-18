<?php
$this->breadcrumbs+=array(
	Yii::t('mavro', 'Buy MAVRO')
);
?>
<h1><?php echo Yii::t('mavro', 'Buy MAVRO')?></h1>

<div align="center">
<div class="form" style="width: 300px; border:1px solid green">
    <?php
    /* @var $form  CActiveForm */
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'deposit-form',
        'enableAjaxValidation'=>false,
    )); ?>
    <table>
        <tr>
            <th><?php echo Yii::t('mavro', 'Buy rate'); ?></th>
            <td>
                <?php
                    $rates = Yii::app()->mavro->getTodayRates();
                    echo $rates[0];
                ?>
            </td>
        </tr>
        <tr>
            <th><?php echo Yii::t('mavro', 'Buy at'); ?></th>
            <td class="row">
                <?php echo $form->textField($model,'amount'); ?>
                <?php echo $form->error($model,'amount'); ?>
            </td>
        </tr>
    </table>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
</div>
<p style="text-align: center;">
    <object data="http://sergey-mavrodi.com/img/calc_new6.swf" height="560" id="game" type="application/x-shockwave-flash" width="600">
        <param name="allowScriptAccess" value="sameDomain">
        <param name="wmode" value="transparent">
        <param name="movie" value="http://sergey-mavrodi.com/img/calc_new6.swf">
        <param name="quality" value="high">
        <param name="flashvars" value="money=3000&amp;percent=50&amp;mounth=12&amp;valuta=1&amp;link=">
    </object>
</p>