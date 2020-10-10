<?php

namespace app\support\helpers;

use Closure;

final class Common
{
	/**
	 * 返回给定的默认值
	 *
	 * @param $value
	 * @return mixed
	 */
	public static function value($value)
	{
		return $value instanceof Closure ? $value() : $value;
	}
}
