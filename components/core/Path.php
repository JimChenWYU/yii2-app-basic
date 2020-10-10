<?php

namespace app\components\core;

use yii\base\BootstrapInterface;
use yii\base\Component;

class Path extends Component implements BootstrapInterface
{
	/**
	 * @var string
	 */
	public $basePath;

	public function bootstrap($app)
	{
		if ($this->basePath === null) {
			$this->basePath = rtrim($app->getBasePath(), DIRECTORY_SEPARATOR);
		}
	}

	public function app($path = '')
	{
		return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	public function runtime($path = '')
	{
		return $this->app('runtime') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	public function config($path = '')
	{
		return $this->app('config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
	}

	public function environmentPath()
	{
		return $this->app();
	}

	public function environmentFile()
	{
		return '.env';
	}

	public function environmentFilePath()
	{
		return $this->environmentPath() . DIRECTORY_SEPARATOR . $this->environmentFile();
	}
}
