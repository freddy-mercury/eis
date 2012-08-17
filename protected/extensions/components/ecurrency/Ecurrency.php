<?php
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'AbstractEcurrencyApi.php');
class Ecurrency extends ExtendedApplicationComponent
{

	public function init()
	{

	}

	public function getComponentsNames()
	{
		$names = array();
		$config = $this->getComponentsConfig();
		foreach ($config as $abbr => $c) {
			if (!isset($c['enabled']) || $c['enabled']) {
				$names[$abbr] = $c['name'];
			}
		}
		return $names;
	}

}