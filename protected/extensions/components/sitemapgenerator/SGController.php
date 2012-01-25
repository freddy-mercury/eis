<?php
/**
 * Sitemap generator
 * @author Evgeny Lexunin <lexunin@gmail.com>
 * @link http://www.yiiframework.com/extension/sitemapgenerator/
 * @link http://code.google.com/p/yii-sitemapgenerator/
 * @version 0.8a
 * @license New BSD
 */
class SGController extends CController
{
	public $config=array('sitemap'=>array());
	public $disable_weblogroutes=true;
	public $weblogroutes=array('CWebLogRoute','CProfileLogRoute','YiiDebugToolbarRoute');
	public $cache_record_id='sitemap_generator_file-';
	public $import=array();
	public $force_include=false;
	public $cache=array();
	
	public function actionIndex($mapName='')
	{
		$config=$this->normalizeConfig($this->config);
		$mapName=basename($mapName,'.xml');
		require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'SitemapGenerator.php');
		
		if (!empty($this->import))
			SitemapGenerator::importAliases(array('import'=>$this->import,'force_include'=>$this->force_include));
		
		try {
			if (!is_array($config))
				throw new Exception(Yii::t('sitemapgenerator.msg','Sitemaps configuration must be set as an array.'));

			if (!isset($config['sitemap']))
				throw new Exception(Yii::t('sitemapgenerator.msg','Main sitemap file (sitemap.xml) must have configuration.'));

			if (!isset($config[$mapName]))
				throw new CHttpException(404,Yii::t('sitemapgenerator.msg','Sitemap file not founded or disabled.'));

			$map_config=$config[$mapName];
			if (!is_array($map_config))
				throw new Exception(Yii::t('sitemapgenerator.msg','Sitemap file configuration must be set as an array.'));

				// Prepare
			$this->setHeaders();
			if ($this->disable_weblogroutes)
				$this->disableWebLogRoutes();
			$this->mergeCacheParams($this->cache,$map_config);
			
				// Cache
			$cachemode=false;
			if (isset($map_config['cache']) && (!empty($map_config['cache']))) {
				$cache=Yii::app()->{$map_config['cache'][0]};
				if ($cache===null)
					throw new Exception(Yii::t('sitemapgenerator.msg','Specified cache component not founed. Cache ID: {value}',array('{value}'=>$map_config['cache'][0])));
				$output=$cache->get($this->cache_record_id);
				$cachemode=true;
				ob_start();
			}
			
				// If has cache
			if (!empty($output)) {
				if (isset($map_config['gzencode']) && $map_config['gzencode']) {
					$this->checkAndDisableGz();
					$this->outputGzData($output);
				} else {
					echo $output;
				}
				ob_get_flush();
				Yii::app()->end();
			}
			
				// GZencode mode
			$gzmode=false;
			if (isset($map_config['gzencode']) && $map_config['gzencode']) {
				$this->checkAndDisableGz();
				$gzmode=true;
				ob_start();
			}
			
				// Pre-import
			if (isset($map_config['import']))
				SitemapGenerator::importAliases($map_config);
			
				// Sitemap render
			if (isset($map_config['index']) && $map_config['index']) { // Index sitemap
				unset($config[$mapName]);
				$this->renderIndex($config);
			} else {									// Basic sitemap
				$this->renderNormal($map_config);
			}
			
				// GZencode mode output
			if ($gzmode) {
				$output=ob_get_clean();
				$gzip_output = gzencode($output,9);
				$this->outputGzData($gzip_output);
			}
			
				// Cache set
			if ($cachemode) {
				$output=ob_get_clean();
				$dur= (isset($map_config['cache'][1])) ? $map_config['cache'][1] : 0;
				$dep= (isset($map_config['cache'][2])) ? $map_config['cache'][2] : null;
				$cache->set($this->cache_record_id.$mapName,$output,$dur,$dep);
				echo $output;
			}
			
		} catch (Exception $e) {
			SitemapGenerator::logExceptionError($e);
			if (YII_DEBUG) throw $e;
		}
	}
	
	/**
	 * Outputs Gz encoded data and sets corresponding headers
	 * @param string $data 
	 */
	private function outputGzData($data)
	{
		header('Content-Encoding: gzip');
		header('Content-Length: '.strlen($data));
		echo $data;
	}
	
	/**
	 * Checks and disables GZ module
	 */
	private function checkAndDisableGz()
	{
		if (!function_exists('gzencode'))
			throw new Exception(Yii::t('sitemapgenerator.msg','Zlib extension must be enabled.'));
		@ini_set('zlib.output_compression',0);
	}
	
	/**
	 * Disables WebLogRouters
	 */
	private function disableWebLogRoutes()
	{
        $log_router = Yii::app()->getComponent('log');
        if ($log_router!==null) {
			$routes=$log_router->getRoutes();
			foreach ($routes as $route)
				foreach ($this->weblogroutes as $route_class)
					if ($route instanceof $route_class) {
						$route->enabled = false;
						break;
					}
		}
	}
	
	/**
	 * Normalizes sitemaps config
	 * @param array $config
	 * @return array 
	 */
	private function normalizeConfig($config)
	{
		$nc=array();
		foreach ($config as $k=>$v)
		{
			if (isset($config[$k]['enabled']) && !$config[$k]['enabled'])
				continue;
			$nk=basename($k,'.xml');
			$nc[$nk]=$v;
			$nc[$nk]['loc']=Yii::app()->createAbsoluteUrl('/'.$nk.'.xml');
		}
			
		return $nc;
	}
	/**
	 * Sets xml and cache headers
	 */
	private function setHeaders()
	{
		header("Content-type: text/xml");
		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
		header('Pragma: no-cache');
	}
	/**
	 * Renders sitemap-index file
	 * @param array $config 
	 */
	private function renderIndex($config)
	{
		$map=new SitemapGenerator;
		$map->createSitemapIndex($config);
		echo $map->getIndexAsXml();
	}
	/**
	 * Renders sitemap file
	 * @param array $config 
	 */
	private function renderNormal($config)
	{
		$map=new SitemapGenerator($config['aliases']);
		$map->setDefaults($config);
		echo $map->getAsXml();
	}
	
	/**
	 * Apply defaults cache parameters to sitemap if it was not set directly
	 * @param array $defaults
	 * @param array $config By reference
	 * @return null
	 */
	private function mergeCacheParams($defaults,&$config)
	{
		if (!is_array($defaults) || (isset($config['cache']) && (!is_array($config['cache']))))
			throw new Exception(Yii::t('sitemapgenerator.msg','Cache configuration must be set as array.'));
		if (empty($defaults))
			return;
		if (!isset($config['cache']))
			$config['cache']=$defaults;
	}
}