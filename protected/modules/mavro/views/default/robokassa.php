<?php
$this->breadcrumbs+=array(
    Yii::t('mavro', 'Buy MAVRO') => array('/mavro/default/index'),
    Yii::t('mavro', 'Confirm'),
);
?>

<h1><?php echo Yii::t('mavro', 'Buy MAVRO') ?></h1>
<script language='javascript' type='text/javascript'
        src='https://merchant.roboxchange.com/Handler/MrchSumPreview.ashx?
MrchLogin=demo&
OutSum=<?php echo $amount ?>&
InvId=0&
Desc=ROBOKASSA+Advanced+User+Guide&
SignatureValue=05d8a10d70a38b7a1ce9d34ea5002d22&
Culture=ru&
IncCurrLabel=AlfaBankR&
Encoding=utf-8'></script>
