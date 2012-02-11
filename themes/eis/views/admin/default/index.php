<?php
$this->breadcrumbs=array(
	$this->module->id,
);
$this->menu=array(
	array('label'=>'Members', 'url'=>array('member/index')),
	array('label'=>'Plans', 'url'=>array('plan/index')),
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<p>
You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
</p>