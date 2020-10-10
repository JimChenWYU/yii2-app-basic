<?php

namespace app\support\helpers;

use Yii;
use hiqdev\composer\config\Builder;
use yii\base\Application;

final class Params
{
	/**
	 * @param null $key
	 * @param \Closure|null $default
	 * @return array|mixed
	 */
	public static function get($key = null, $default = null)
	{
		if (class_exists('Yii') && Yii::$app instanceof Application) {
			$params =  Yii::$app->params;
		} else if (file_exists($path = Builder::path('params'))) {
			$params = (array)require $path;
		} else {
			$params = [];
		}

		if ($key === null) {
			return $params;
		}

		return Arr::get($params, $key, $default);
	}

	/**
	 * @param string $key
	 * @param string|array $value
	 * @return void
	 */
	public static function set(string $key, $value)
	{
		if (class_exists('Yii') && Yii::$app instanceof Application) {
			Arr::set(Yii::$app->params, $key, $value);
		}
	}
}
