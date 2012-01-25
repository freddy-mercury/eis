<?php
/**
 * Sitemap generator UrlManager Rule
 * @author Evgeny Lexunin <lexunin@gmail.com>
 * @link http://www.yiiframework.com/extension/sitemapgenerator/
 * @link http://code.google.com/p/yii-sitemapgenerator/
 * @version 0.8a
 * @license New BSD
 */
/**
 * Configuration:
 * @property string $route Route to controller action for sitemap. Default: /site/sitemap
 */
class SGUrlRule extends CBaseUrlRule
{
	public $route='/sitemap';
	
	public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
	{
		$url=$this->trimBaseUrl($request->url);
		if (substr($url,0,7)==='sitemap') {
			$_GET['mapName']=$url;
			return $this->route;
		} else
			return false;	
	}
	public function createUrl($manager, $route, $params, $ampersand) {
		return false;
	}
	private function trimBaseUrl($url)
	{
		$burl=Yii::app()->baseUrl;
		if (substr($url,0,strlen($burl))===$burl)
			$url=substr($url,strlen($burl));
		return trim($url,'/');
	}
}