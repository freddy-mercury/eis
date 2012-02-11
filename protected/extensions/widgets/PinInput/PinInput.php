<?php
class PinInput extends CWidget
{
	public $model;
	public $attribute;
	public $htmlOptions = array();
	public $config = array();
	
	private static $_count = 0;
	
	public function run()
	{
		$this->registerClientScript();
		echo CHtml::activePasswordField($this->model,$this->attribute,$this->htmlOptions);
	}
	
	private function registerClientScript()
	{
		$assets = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$assets_url = Yii::app()->getAssetManager()->publish($assets,true,-1,YII_DEBUG);
		
		if (isset($this->htmlOptions['id']))
		{
			$id = $this->htmlOptions['id'];
		} else {
			$id = 'piw_'.self::$_count;
			++self::$_count;
			$this->htmlOptions['id'] = $id;
		}
		
		Yii::app()->clientScript->registerCoreScript('jquery');
		Yii::app()->clientScript->registerCssFile($assets_url.'/pininput.css');
		Yii::app()->clientScript->registerScriptFile($assets_url.'/jquery.pininput.js');
		Yii::app()->clientScript->registerScript($id,'$("#'.$id.'").pininput('.CJavaScript::encode($this->config).');');
	}
}