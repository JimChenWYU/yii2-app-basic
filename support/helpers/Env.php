<?php

namespace app\support\helpers;

use yii\helpers\StringHelper;

final class Env
{
	/**
	 * 判断变量存在性
	 *
	 * @param $key
	 * @return bool
	 */
	public static function has($key)
	{
		return self::getEnv($key) !== false;
	}

	/**
	 * 获取环境变量
	 *
	 * @param      $key
	 * @param null $default
	 * @return array|bool|mixed|string|void
	 */
	public static function get($key, $default = null)
	{
		$value = self::getEnv($key);

		if ($value === false) {
			return Common::value($default);
		}

		$value = self::format($value);

		if (strlen($value) > 1 && StringHelper::startsWith($value, '"') && StringHelper::endsWith($value, '"')) {
			return substr($value, 1, -1);
		}

		return $value;
	}


	public static function format($value)
	{
		switch (strtolower($value)) {
			case 'true':
			case '(true)':
				return true;
			case 'false':
			case '(false)':
				return false;
			case 'empty':
			case '(empty)':
				return '';
			case 'null':
			case '(null)':
				return null;
			default:
				return $value;
		}
	}

	/**
	 * @param $key
	 * @return array|false|mixed|string
	 */
	private static function getEnv($key)
	{
		$value = getenv($key);

		if ($value === false) {
			if (is_array($_ENV) && array_key_exists($key, $_ENV)) {
				$value = $_ENV[$key];
				if ($value === false) {
					$value = 'false';
				}
			}
		}

		return $value;
	}
}
