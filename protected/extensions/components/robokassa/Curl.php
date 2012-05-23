<?php

class Curl
{
	private $resource, $error;

	public function __construct()
	{
		$this->resource = curl_init();
	}

	public function setOptions(array $options)
	{
		curl_setopt_array($this->resource, $options);
	}

	public function sendRequest($url, $is_post = false, array $params = array())
	{
		$this->error = '';
		if (!curl_exec($this->resource)) {
			$this->error = curl_error($this->resource);
			return false;
		}
	}

	public function getResponse($url, $is_post = false, array $params = array())
	{
		$this->error = '';
		$this->setOptions(array(
				CURLOPT_RETURNTRANSFER => 1
			)
		);
		$query = http_build_query($this->urlencodeParams($params));
		if ($is_post) {
			$this->setOptions(array(
					CURLOPT_POST => 1,
					CURLOPT_POSTFIELDS => $query,
				)
			);
		}
		else {
			$url .= (strpos($url, '?') !== false ? '&' : '?') . $query;
		}
		$this->setOptions(array(CURLOPT_URL => $url));
		if (!($response = curl_exec($this->resource))) {
			$this->error = curl_error($this->resource);
			return false;
		}
		return $response;
	}

	private function urlencodeParams(array $params = array())
	{
		return array_map(function($param)
		{
			return urlencode($param);
		}, $params);
	}

	public function getError()
	{
		return $this->error;
	}
}
