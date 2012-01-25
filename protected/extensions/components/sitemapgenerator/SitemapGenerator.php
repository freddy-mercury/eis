<?php
/**
 * Sitemap generator
 * @author Evgeny Lexunin <lexunin@gmail.com>
 * @link http://www.yiiframework.com/extension/sitemapgenerator/
 * @link http://code.google.com/p/yii-sitemapgenerator/
 * @version 0.8a
 * @license New BSD
 */
/**
 * Requirements:
 * Yii 1.1.8 (other versions not tested)
 * PHP 5.2 or later
 * PHP Reflection extension
 * PHP SimpleXML extension
 * 
 * Syntax of docComment:
 * @sitemap [options separated by spaces]
 * 
 * Options:
 *	route=value				- overrides route value for Yii::app()->createAbsoluteUrl($route,$params),
 *	priority=value			- overrides $default_priority value for sitemap,
 *	lastmod=value			- overrides lastmod value for sitemap (by default is today),
 *	changefreq=value		- overrides $default_changefreq value for sitemap,
 *	loc=value				- overrides loc value for sitemap (disables link generation, not set by default),
 *	dataSource=methodName	- public method of controller for generating urls array formatted data.
 * 
 * Important:
 * If 'loc' option is given, it will override link generation
 * and will be inserted without url normalizing. Http host information
 * will not be added. So if you wish to use it, then you will have to set it as:
 *		loc=http://www.example.com
 * Otherwise, use 'route' option.
 * 
 * dataSource method must return array of urls data (array formatted):
 
array(
	array(
		'route'=>'/site/page',					// or 'loc'=>'http://www.example.com/specialLocation',
		'params'=>array('view'=>'about'),
		'priority'=>0.8,
		'changefreq'=>'monthly',
		'lastmod'=>'2012-12-25',
	),
	array(
		...
	),
	...
);

 * All keys are optional. If not set, then will be used values from docComment options,
 * and then default values.
 */
class SitemapGenerator
{
	public $default_changefreq='monthly';
	public $default_priority=0.8;
	public $default_lastmod;
	public $default_routeStructure='application,modules,controllers';
	public $default_model_params='model:id';
	public $default_view_param='view';
	
	/**
	 * @var array of aliases to controllers location
	 */
	private $_aliases=array('application.controllers');
	
	private $_xml;
	private $_url_counter=0;
	private $_xml_index;
	private $_sitemap_counter=0;
	
	/**
	 * Construct method
	 */
	public function __construct($aliases=null)
	{
		$xml=<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</urlset> 
XML;
		$xml_index=<<<XMLINDEX
<?xml version='1.0' encoding='UTF-8'?>
<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
</sitemapindex>
XMLINDEX;
		if (!class_exists('SimpleXMLElement'))
			throw new Exception(Yii::t('sitemapgenerator.msg','SimpleXML extension is required.'));
		
		if (!class_exists('ReflectionClass'))
			throw new Exception(Yii::t('sitemapgenerator.msg','Reflection extension is required.'));
		
		if ($aliases!==null)
			$this->_aliases=self::configToArray($aliases);
		
		$this->default_lastmod=$this->getDefaultLastmod();
		
		$this->_xml=new SimpleXMLElement($xml);
		$this->_xml_index=new SimpleXMLElement($xml_index);
	}
	
	/**
	 * Returns XML formatted sitemap
	 * @return string XML formatted
	 */
	public function getAsXml()
	{
		$this->scanControllersAliases();
		return $this->_xml->asXML();
	}
	
	/**
	 * Returns XML formatted sitemap index
	 * @return string XML formatted
	 */
	public function getIndexAsXml()
	{
		return $this->_xml_index->asXML();
	}
	
	/**
	 * Creates sitemap index xml file
	 * @param array $sitemaps 
	 */
	public function createSitemapIndex($sitemaps)
	{
		if (!is_array($sitemaps))
			throw new Exception(Yii::t('sitemapgenerator.msg','Sitemaps must be set as array. Current value: {value}',array('{value}'=>print_r($params['params'],true))));
		
		foreach($sitemaps as $s)
			$this->addSitemap($s);
	}
	
	/**
	 * Sets default values for sitemap
	 * @param array $defaults 
	 */
	public function setDefaults($defaults)
	{
		if (!is_array($defaults))
			throw new Exception(Yii::t('sitemapgenerator.msg',"Sitemap defaults must be set as an array."));
		
		if (!empty($defaults)) {
			if (isset($defaults['changefreq']))
				$this->default_changefreq=$defaults['changefreq'];
			if (isset($defaults['priority']))
				$this->default_priority=$defaults['priority'];
			if (isset($defaults['lastmod']))
				$this->default_lastmod=$defaults['lastmod'];
			if (isset($defaults['routeStructure']))
				$this->default_routeStructure=$defaults['routeStructure'];
		}
	}
	
	/**
	 * Scan all given aliases
	 */
	private function scanControllersAliases()
	{
		if (empty($this->_aliases))
				throw new Exception(Yii::t('sitemapgenerator.msg','Controllers aliases is not set.'));
		
		foreach ($this->_aliases as $k=>$v)
		{
			if (is_int($k))		// Basic aliases mode
				$this->scanControllers($v);
			elseif (is_string($k)) {	// Extended aliases mode
				if (is_array($v) && isset($v['import']))
					self::importAliases($v);
				$this->scanControllers($k);
			}
		}
	}
		
	/**
	 * Scan alias
	 * @param string $alias 
	 */
	private function scanControllers($alias)
	{
		$path=Yii::getPathOfAlias($alias);
		
		if (empty($path))
			throw new Exception(Yii::t('sitemapgenerator.msg',"Alias path not founded. Alias: '{alias}'",array('{alias}'=>$alias)));
		
		if (is_dir($path)) {
			$files=scandir(Yii::getPathOfAlias($alias));
			foreach ($files as $file)
				if (($pos=strpos($file,'Controller'))!==false) 
						$this->parseController($alias.'.'.basename($file,'.php'));
		} elseif (is_file($path.'.php')) {
			if (($pos=strpos(basename($path),'Controller'))!==false) 
				$this->parseController($alias);
		} else
			throw new Exception(Yii::t('sitemapgenerator.msg',"Alias is not directory or file. Alias: '{alias}'",array('{alias}'=>$alias)));
	}
	
	/**
	 * Parses controllers methods to gain urls data
	 * @param string $alias Alias of Controler class file
	 */
	private function parseController($alias)
	{
		$parts=explode('.',$alias);
		$class=array_pop($parts);
		Yii::import($alias,true);
		$cntr=new ReflectionClass($class);
		$controller_instance=null;
		$methods=$cntr->getMethods();
		
		foreach ($methods as $m)
		{
			$comment=$m->getDocComment();
			if (strpos($comment, '@sitemap')!==false) {		// Precheck with quick function
				$results=array();
				preg_match_all('/@sitemap(.*)/u', $comment, $results);
				
				foreach ($results[1] as $result)
				{
																// Parse params
					$params= (!empty($result)) ? $this->parseParamsString($result) : array();
					$action=$m->name;

					if (isset($params['dataSource'])) {			// get dataSource to urls_data
						$data_method=$params['dataSource'];

						if (substr($data_method,0,6)==='model:') // Model Urls
							$this->harvestModelUrlData($params);
						elseif (substr($data_method,0,5)==='view:') { // View Urls
								// CActionView GET parameter resolving
							if ($m->name==='actions') {
								if ($controller_instance===null)
									$controller_instance=new $class('tempInstance');
								$actions=$controller_instance->actions();
								foreach ($actions as $a_name=>$a_params)
									if ($a_params['class']==='CViewAction') {
										if (isset($a_params['viewParam']))
											$this->default_view_param=$a_params['viewParam'];
										$action='action'.$a_name;
									}
							}
							
							$this->harvestViewUrlData($params);
						} else {										// Method Urls
							if ($controller_instance===null)
								$controller_instance=new $class('tempInstance');
							$params['urls_data']=$controller_instance->{$data_method}();
						}
					}
					
					$route=$this->createRoute($alias,$action);
					$this->parseUrls($route,$params);
				}
			}
		}
	}
	
	/**
	 * Harvests model URLs by given parameters
	 * Returns all harvested data into $params['urls_data']
	 * @param array $params Passed by reference
	 */
	private function harvestModelUrlData(&$params)
	{
		$data=array();
		$attr_list=array('lastmod','priority','changefreq','loc');
		$attr_params=array();
		
		foreach($attr_list as $attr)
			$attr_params[$attr]=$this->parseModelAttr($params[$attr]);
		
		if (!isset($params['params']))
			$params['params']=$this->default_model_params;
		
		$attr_params['params']=$this->parseModelAttr($params['params'],'/^[\w\,]+$/ui');
			
		$model_data_name=substr($params['dataSource'],6);
		
		if (preg_match('/^\w+$/ui', $model_data_name)) {
			$models=$this->evalModelAttr($model_data_name.'::model()->findAll()');
		} else
			$models=$this->evalModelAttr($model_data_name);
		
		if ($models!==null && is_array($models))
			foreach ($models as $model)
			{
				$pa=array();
					// Common parameters ($attr_list) evaluation
				foreach($attr_list as $attr)
					if ($attr_params[$attr]['value']!==null)
						$pa[$attr]= ($attr_params[$attr]['simple']) ? $model->{$attr_params[$attr]['value']} : $this->evalModelAttr($attr_params[$attr]['value'],$model) ;
					
					// 'params' parameter evaluation
				if ($attr_params['params']['value']!==null) {
					$params_data=array();
					if ($attr_params['params']['simple']) {
						$all_params_attrs=explode(',',$attr_params['params']['value']);
						foreach ($all_params_attrs as $attr)
							$params_data[$attr]=$model->{$attr};
					} else {
						$params_data=$this->evalModelAttr($attr_params['params']['value'],$model);
					}
					$pa['params']=$params_data;
				}
						
				$data[]=$pa;
			}
		$params['urls_data']=$data;
	}
	
	/**
	 * Parses URL parameter if it's set as model attribute ('model:..')
	 * @param string $param Full parameter value
	 * @param string $simple_criteria_pattern Regex pattern for detecting simple form of record
	 * @return array Of parsed value and 'simple' marker
	 */
	private function parseModelAttr($param,$simple_criteria_pattern='/^\w+$/ui')
	{
		$attr=null;
		$simple=false;
		if (substr($param,0,6)==='model:') {
			$attr=trim(substr($param,6));
			if (empty($attr))
				$attr=null;
			elseif (preg_match($simple_criteria_pattern, $attr))
				$simple=true;
		}
		return array('value'=>$attr,'simple'=>$simple);
	}
	
	/**
	 * Evaluates model attribute by given expression
	 * Throws exception on evaluation error.
	 * @param string $attr_expr Given expression
	 * @param CActiveRecord $data AR model
	 * @return mixed Evaluation result
	 */
	private function evalModelAttr($attr_expr,$data=null)
	{
		ob_start();
		$result=eval('return '.$attr_expr.';');
		ob_end_clean();
		if ($result===false)
			throw new Exception(Yii::t('sitemapgenerator.msg','Error occured while trying to eval() model expression. Expression was: {value}',array('{value}'=>$attr_expr)));
		return $result;
	}
	
	/**
	 * Harvests views URLs by given parameters
	 * Used for CViewAction class
	 * Returns all harvested data into $params['urls_data']
	 * @link http://www.yiiframework.com/doc/api/1.1/CViewAction
	 * @param array $params Passed by reference
	 */
	private function harvestViewUrlData(&$params)
	{
		$data=array();
		$view_aliases=self::configToArray(substr($params['dataSource'],5));
		
			// View GET parameter
		if (isset($params['params']) && (substr($params['params'],0,5)==='view:'))
			$view_param=trim(substr($params['params'],5));
		if (empty($view_param))
			$view_param=$this->default_view_param;
		
		foreach ($view_aliases as $alias)
		{
			$path=Yii::getPathOfAlias($alias);
			if (is_dir($path)) {
				$files=CFileHelper::findFiles($path,array(
					'fileTypes'=>array('php'),
					'exclude'=>array('.svn'),
					'level'=>0,
					));
				foreach ($files as $file)
					$data[]=$this->getUrlByViewFile($file,$view_param);
			} elseif (is_file($path.'.php')) {
				$data[]=$this->getUrlByViewFile($path.'.php',$view_param);
			} else {
				throw new Exception(Yii::t('sitemapgenerator.msg',"Alias is not directory or file. Alias: '{alias}'",array('{alias}'=>$alias)));
			}
		}
		$params['urls_data']=$data;
	}
	
	/**
	 * Returns URL data for view file
	 * @param string $file Filepath
	 * @param string $view_param GET parameter for URL view
	 * @return array
	 */
	private function getUrlByViewFile($file,$view_param)
	{
		$data=array();
		$t=filemtime($file);
		if ($t!==false)
			$data['lastmod']=$t;
		$data['params']=array($view_param=>basename($file,'.php'));
		return $data;
	}
	
	/**
	 * Creates route by given parameters
	 * @param string $alias to controller class file
	 * @param string $action_method_name of controller
	 * @return string 
	 */
	private function createRoute($alias,$action_method_name)
	{
		if (!function_exists('lcfirst')) {	// php 5.2 fix
			function lcfirst($str) { $str{0}=strtolower($str{0}); return $str; }
		}
		$route=explode('.',$alias);
		$action=lcfirst(substr($action_method_name,strlen('action')));
		$controller=lcfirst(substr(array_pop($route),0,-strlen('Controller')));
		$route=array_diff($route,self::configToArray($this->default_routeStructure));
		$route[]=$controller;
		$route[]=$action;
		return '/'.implode('/',$route);
	}
	
	/**
	 * Parses params string from methods docComment
	 * @param string $string
	 * @return array 
	 */
	private function parseParamsString($string)
	{
		$raw=explode(' ',$string);
		$raw=array_filter($raw);
		$data=array();
		foreach ($raw as $param) {
			list($key,$val)=explode('=',$param,2);
			
			if (empty($val))
				throw new Exception(Yii::t('sitemapgenerator.msg',"Option '{key}' cannot be empty.",array('{key}'=>$key)));
			
			$data[$key]=$val;
		}
		return $data;
	}
	
	/**
	 * Returns default lastmod value (current date)
	 * @return string
	 */
	private function getDefaultLastmod()
	{
		return date(DATE_W3C);
	}
	
	/**
	 * Parses and adds urls to current xml sitemap
	 * 
	 * @param string $route
	 *					- parsed route to controller action
	 * 
	 * @param array $data Keys:
	 * route			- given by user route (overrides parsed $route)
	 * params			- given by user array of params for route normalize
	 * 
	 * loc				- given by user 'loc' param (overrides link generation)
	 * priority			- given by user priority
	 * changefreq		- given by user chengefreq
	 * lastmod			- given by user lastmod
	 * 
	 * urls_data		- data array returned by dataSource method of controller
	 * dataSource		- controllers method name to gain 'url_data'
	 */
	private function parseUrls($route,$data)
	{
		$default['route']=isset($data['route']) ? $data['route'] : $route;
		$default['priority']=isset($data['priority']) ? $data['priority'] : $this->default_priority;
		$default['changefreq']=isset($data['changefreq']) ? $data['changefreq'] : $this->default_changefreq;
		if (isset($data['loc'])) $default['loc']=$data['loc'];
		$default['lastmod']=isset($data['lastmod']) ? $data['lastmod'] : $this->default_lastmod;
		$default['params']=array();

		if (isset($data['urls_data']))
			foreach ($data['urls_data'] as $item)
				$this->addUrl(CMap::mergeArray($default, $item));
		else
			$this->addUrl($default);
	}
	
	/**
	 * Adds url to current xml sitemap
	 * @param array $params Keys:
	 * loc			- loc attribute (overrides link generation)
	 * route		- used to generate link (at Yii::app()->createAbsoluteUrl)
	 * params		- user to generate link (at Yii::app()->createAbsoluteUrl)
	 * lastmod		- lastmod attribute
	 * changefreq	- changefreq attribute
	 * priority		- priority attribute
	 */
	private function addUrl($params)
	{
		try {
			/* 
			 * Max urls per file: 
			 * http://www.sitemaps.org/faq.php#faq_sitemap_size
			 */
			if ($this->_url_counter>=50000)
				throw new Exception(Yii::t('sitemapgenerator.msg','URLs quantity limit per sitemap file exceeded.'));

			if (!is_array($params['params']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url parameters must be set as array. Current value: {value}',array('{value}'=>print_r($params['params'],true))));
			if (!isset($params['route']) && !isset($params['loc']))
				throw new Exception(Yii::t('sitemapgenerator.msg','"route" or "loc" options must be set.'));
			if (isset($params['route']) && !is_string($params['route']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url route must be set as string. Current value: {value}',array('{value}'=>print_r($params['route'],true))));
			if (!is_string($params['changefreq']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url changefreq must be set as string. Current value: {value}',array('{value}'=>print_r($params['changefreq'],true))));
			if (isset($params['loc']) && !is_string($params['loc']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url loc must be set as string. Current value: {value}',array('{value}'=>print_r($params['loc'],true))));
			if (!is_string($params['lastmod']) && !is_int($params['lastmod']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url lastmod must be set as string. Current value: {value}',array('{value}'=>print_r($params['lastmod'],true))));

			$link= !isset($params['loc']) ? Yii::app()->createAbsoluteUrl($params['route'],$params['params']) : $params['loc'] ;
			$xmlurl=$this->_xml->addChild('url');
			$xmlurl->addChild('loc',CHtml::encode($link));
			$xmlurl->addChild('lastmod',$this->formatDatetime($params['lastmod']));
			$xmlurl->addChild('changefreq',$params['changefreq']);
			$xmlurl->addChild('priority',$params['priority']);
			++$this->_url_counter;
		} catch (Exception $e) {
			self::logExceptionError($e);
			if (YII_DEBUG) throw $e;
		}
	}
	
	/**
	 * Adds sitemap to current sitemap-index xml
	 * @param array $params
	 */
	private function addSitemap($params)
	{
		try {
			/* 
			 * Max sitemaps per sitemap-index file : 
			 * http://www.sitemaps.org/faq.php#faq_sitemap_size
			 */
			if ($this->_sitemap_counter>=1000)
				throw new Exception(Yii::t('sitemapgenerator.msg','Sitemaps quantity limit per sitemap-index file exceeded.'));

			if (!isset($params['lastmod']))
				$params['lastmod']=$this->default_lastmod;
			if (!isset($params['params']))
				$params['params']=array();

			if (!is_array($params['params']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url parameters must be set as array. Current value: {value}',array('{value}'=>print_r($params['params'],true))));
			if (!isset($params['route']) && !isset($params['loc']))
				throw new Exception(Yii::t('sitemapgenerator.msg','"route" or "loc" options must be set.'));
			if (isset($params['route']) && !is_string($params['route']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url route must be set as string. Current value: {value}',array('{value}'=>print_r($params['route'],true))));
			if (isset($params['loc']) && !is_string($params['loc']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url loc must be set as string. Current value: {value}',array('{value}'=>print_r($params['loc'],true))));
			if (!is_string($params['lastmod']) && !is_int($params['lastmod']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Url lastmod must be set as string. Current value: {value}',array('{value}'=>print_r($params['lastmod'],true))));

			$link= !isset($params['loc']) ? Yii::app()->createAbsoluteUrl($params['route'],$params['params']) : $params['loc'] ;

			$sitemap=$this->_xml_index->addChild('sitemap');
			$sitemap->addChild('loc',CHtml::encode($link));
			$sitemap->addChild('lastmod',$this->formatDatetime($params['lastmod']));
			++$this->_sitemap_counter;
		} catch (Exception $e) {
			self::logExceptionError($e);
			if (YII_DEBUG) throw $e;
		}
	}
	
	/**
	 * Formats given date to W3C datetime format
	 * @param mixed $val
	 * @return string 
	 */
	private function formatDatetime($val)
	{
		try {
			if (is_int($val)) {
				$result=date(DATE_W3C,$val);
			} elseif (is_string($val)) {
				$dt=new DateTime($val);
				$result=$dt->format(DateTime::W3C);
				if ($result===false)
					throw new Exception(Yii::t('sitemapgenerator.msg','Unable to format datetime object. Datetime value: {value}',array('{value}'=>$val)));
			}
		} catch (Exception $e) {
			throw new Exception(Yii::t('sitemapgenerator.msg','Unable to parse given datetime. Error: {error}',array('{error}'=>$e->getMessage())));
		}
		return $result;
	}
	
	/**
	 * Formats config data to array.
	 * @param mixed $data
	 * @return array
	 */
	public static function configToArray($data)
	{
		if (is_array($data))
			return $data;
		elseif (is_string($data))
			return array_filter(explode(',',$data));
		else
			throw new Exception(Yii::t('sitemapgenerator.msg','Aliases elements must be set as string or an array.'));
	}
	
	/**
	 * Logs current exception error
	 * @param Exception $e 
	 */
	public static function logExceptionError($e)
	{
	    Yii::log(Yii::t('sitemapgenerator.msg','SitemapGenerator error: {error}',array('{error}'=>$e->getMessage())), CLogger::LEVEL_ERROR, 'application.sitemapGenerator');
	}
	
	/**
	 * Imports specified aliases
	 * @param array $config array('import'=>{string|array},'force_include'=>{boolean})
	 */
	public static function importAliases($config)
	{
		$force_include=(isset($config['force_include']) && $config['force_include']);
		$aliases=self::configToArray($config['import']);
		foreach ($aliases as $alias)
			Yii::import($alias,$force_include);
	}
}