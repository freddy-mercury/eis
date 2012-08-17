<h1>
    <?php echo Yii::t('global', 'Rates') ?>
</h1>

<div style="overflow: auto; height: 500px">
    <?php
    echo Rates::renderTable();
    ?>
</div>