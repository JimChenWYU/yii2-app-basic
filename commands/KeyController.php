<?php

namespace app\commands;

use Yii;
use app\components\core\Path;
use app\support\helpers\Env;
use Dotenv\Dotenv;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\di\Instance;
use yii\helpers\Console;

class KeyController extends Controller
{
	/**
	 * @var Path|string
	 */
	private $_pathObj = 'path';

	public function init()
	{
		$this->_pathObj = Instance::ensure('path', Path::class);
		$dotenv = Dotenv::createImmutable([
			$this->_pathObj->environmentPath()
		]);
		$dotenv->load();
	}

	/**
	 * 生成 CookieValidationKey
	 */
	public function actionGenerate()
	{
		$key = Yii::$app->getSecurity()->generateRandomString();

		if (! $this->setKeyInEnvironmentFile($key)) {
			return ExitCode::OK;
		}

		Console::output(Console::ansiFormat("CookieValidationKey [$key] 设置成功", [
			Console::BG_GREEN
		]));

		return ExitCode::OK;
	}


	/**
	 * Set the application key in the environment file.
	 *
	 * @param  string  $key
	 * @return bool
	 */
	protected function setKeyInEnvironmentFile($key)
	{
		$currentKey = Env::get('APP_KEY', '');

		if (strlen($currentKey) !== 0 && (! Console::confirm('确定重新生成 CookieValidationKey 吗？', false))) {
			return false;
		}

		$this->writeNewEnvironmentFileWith($key);

		return true;
	}

	/**
	 * Write a new environment file with the given key.
	 *
	 * @param  string  $key
	 * @return void
	 */
	protected function writeNewEnvironmentFileWith($key)
	{
		file_put_contents($this->_pathObj->environmentFilePath(), preg_replace(
			$this->keyReplacementPattern(),
			'APP_KEY='.$key,
			file_get_contents($this->_pathObj->environmentFilePath())
		));
	}

	/**
	 * Get a regex pattern that will match env APP_KEY with any random key.
	 *
	 * @return string
	 */
	protected function keyReplacementPattern()
	{
		$escaped = preg_quote('='.Env::get('APP_KEY', ''), '/');

		return "/^APP_KEY{$escaped}/m";
	}
}
