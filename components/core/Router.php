<?php

namespace app\components\core;

use Yii;
use yii\base\BootstrapInterface;
use yii\helpers\FileHelper;
use yii\web\UrlManager;

class Router extends UrlManager implements BootstrapInterface
{
	public $routes = '@app/routes';

	public function init()
	{
		$this->routes = Yii::getAlias($this->routes);
		return parent::init();
	}

	public function get($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function head($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function post($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function put($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function patch($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function delete($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function options($uri, array $ruleConfig)
	{
		$this->request(__METHOD__, $uri, $ruleConfig);
	}

	public function request($method, $uri, array $ruleConfig)
	{
		$urlRules = [
			"$method $uri" => $ruleConfig
		];

		$this->addRules($urlRules);
	}

	public function bootstrap($app)
	{
		$files = FileHelper::findFiles($this->routes);
		$route = $this;
		foreach ($files as $file) {
			require $file;
		}
		unset($route);
	}
}
