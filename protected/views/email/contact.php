From: <?= $from ?><br>
Subject: <?= CHtml::encode($subject) ?><br>
Body:
<p><?echo CHtml::encode($body);?></p><br/><br/>
<hr/>
<p>User service information:
<ul>
<li>IP: <?php echo $_SERVER['REMOTE_ADDR']; ?>
<li>USER_AGENT: <?php echo $_SERVER['HTTP_USER_AGENT']; ?>
<li>HOST: <?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>
<li>REFERER: <?php echo @$_SERVER['HTTP_REFERER']; ?>
</ul>
</p>