<?php

namespace app\support\helpers;

use BadMethodCallException;
use yii\helpers\ArrayHelper;
use Tightenco\Collect\Support\Arr as BaseArr;

/**
 * Class Arr
 * @mixin \Tightenco\Collect\Support\Arr
 */
final class Arr extends ArrayHelper
{
	/**
	 * Set an array item to a given value using "dot" notation.
	 *
	 * If no key is given to the method, the entire array will be replaced.
	 *
	 * @param  array  $array
	 * @param  string|null  $key
	 * @param  mixed  $value
	 * @return array
	 */
	public static function set(&$array, $key, $value)
	{
		if (is_null($key)) {
			return $array = $value;
		}

		$keys = explode('.', $key);

		foreach ($keys as $i => $k) {
			if (count($keys) === 1) {
				break;
			}

			unset($keys[$i]);

			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if (! isset($array[$k]) || ! is_array($array[$k])) {
				$array[$k] = [];
			}

			$array = &$array[$k];
		}

		$array[array_shift($keys)] = $value;

		return $array;
	}

	/**
	 * @param $method
	 * @param $arguments
	 * @return mixed
	 */
	public static function __callStatic($method, $arguments)
	{
		if (method_exists(BaseArr::class, $method)) {
			return forward_static_call_array([BaseArr::class, $method], $arguments);
		}

		throw new BadMethodCallException(sprintf(
			'Method %s::%s does not exist.', static::class, $method
		));
	}

	/**
	 * @deprecated
	 * @see get()
	 *
	 * @param array|object          $array
	 * @param array|\Closure|string $key
	 * @param null                  $default
	 * @return mixed|null
	 * @throws \Exception
	 */
	public static function getValue($array, $key, $default = null)
	{
		return parent::getValue($array, $key, $default);
	}

	/**
	 * @deprecated
	 * @see set()
	 *
	 * @param array             $array
	 * @param array|string|null $path
	 * @param mixed             $value
	 */
	public static function setValue(&$array, $path, $value)
	{
		parent::setValue($array, $path, $value);
	}
}
