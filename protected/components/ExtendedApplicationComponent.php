<?php
class ExtendedApplicationComponent extends CApplicationComponent
{
	public $preload;
	
	private $_componentConfig=array();
	private $_components=array();
	
	/**
	 * Checks whether the named component exists.
	 * @param string $id application component ID
	 * @return boolean whether the named application component exists (including both loaded and disabled.)
	 */
	public function hasComponent($id)
	{
		return isset($this->_components[$id]) || isset($this->_componentConfig[$id]);
	}

	/**
	 * Retrieves the named application component.
	 * @param string $id application component ID (case-sensitive)
	 * @param boolean $createIfNull whether to create the component if it doesn't exist yet.
	 * @return IApplicationComponent the application component instance, null if the application component is disabled or does not exist.
	 * @see hasComponent
	 */
	public function getComponent($id,$createIfNull=true)
	{
		if(isset($this->_components[$id]))
			return $this->_components[$id];
		else if(isset($this->_componentConfig[$id]) && $createIfNull)
		{
			$config=$this->_componentConfig[$id];
			if(!isset($config['enabled']) || $config['enabled'])
			{
				Yii::trace("Loading \"$id\" component");
				unset($config['enabled']);
				$component=Yii::createComponent($config);
				$component->init();
				return $this->_components[$id]=$component;
			}
		}
	}

	/**
	 * Puts a component under the management of the module.
	 * The component will be initialized by calling its {@link CApplicationComponent::init() init()}
	 * method if it has not done so.
	 * @param string $id component ID
	 * @param IApplicationComponent $component the component to be added to the module.
	 * If this parameter is null, it will unload the component from the module.
	 */
	public function setComponent($id,$component)
	{
		if($component===null)
			unset($this->_components[$id]);
		else
		{
			$this->_components[$id]=$component;
			if(!$component->getIsInitialized())
				$component->init();
		}
	}

	/**
	 * Returns the application components.
	 * @param boolean $loadedOnly whether to return the loaded components only. If this is set false,
	 * then all components specified in the configuration will be returned, whether they are loaded or not.
	 * Loaded components will be returned as objects, while unloaded components as configuration arrays.
	 * This parameter has been available since version 1.1.3.
	 * @return array the application components (indexed by their IDs)
	 */
	public function getComponents($loadedOnly=true)
	{
		if($loadedOnly)
			return $this->_components;
		else
			return array_merge($this->_componentConfig, $this->_components);
	}

	/**
	 * Sets the application components.
	 *
	 * When a configuration is used to specify a component, it should consist of
	 * the component's initial property values (name-value pairs). Additionally,
	 * a component can be enabled (default) or disabled by specifying the 'enabled' value
	 * in the configuration.
	 *
	 * If a configuration is specified with an ID that is the same as an existing
	 * component or configuration, the existing one will be replaced silently.
	 *
	 * The following is the configuration for two components:
	 * <pre>
	 * array(
	 *     'db'=>array(
	 *         'class'=>'CDbConnection',
	 *         'connectionString'=>'sqlite:path/to/file.db',
	 *     ),
	 *     'cache'=>array(
	 *         'class'=>'CDbCache',
	 *         'connectionID'=>'db',
	 *         'enabled'=>!YII_DEBUG,  // enable caching in non-debug mode
	 *     ),
	 * )
	 * </pre>
	 *
	 * @param array $components application components(id=>component configuration or instances)
	 * @param boolean $merge whether to merge the new component configuration with the existing one.
	 * Defaults to true, meaning the previously registered component configuration of the same ID
	 * will be merged with the new configuration. If false, the existing configuration will be replaced completely.
	 */
	public function setComponents($components,$merge=true)
	{
		foreach($components as $id=>$component)
		{
			if($component instanceof IApplicationComponent)
				$this->setComponent($id,$component);
			else if(isset($this->_componentConfig[$id]) && $merge)
				$this->_componentConfig[$id]=CMap::mergeArray($this->_componentConfig[$id],$component);
			else
				$this->_componentConfig[$id]=$component;
		}
	}
	
	/**
	 * Loads static application components.
	 */
	protected function preloadComponents()
	{
		foreach($this->preload as $id)
			$this->getComponent($id);
	}

	/**
	 * Initializes the module.
	 * This method is called at the end of the module constructor.
	 * Note that at this moment, the module has been configured, the behaviors
	 * have been attached and the application components have been registered.
	 * @see preinit
	 */
	public function init()
	{
	}
	
	public function getComponentsConfig()
	{
		return $this->_componentConfig;
	}
}