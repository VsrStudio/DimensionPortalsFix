<?php

declare(strict_types=1);

namespace muqsit\dimensionportals\utils;

use Closure;

final class ArrayUtils{

	/**
	 * @param mixed[] $array
	 * @param Closure $condition
	 * @param mixed|null $fallback
	 * @return mixed|null
	 */
	public static function firstOrDefault(array $array, Closure $condition, $fallback = null){
		foreach($array as $index => $element){
			if($condition($index, $element)){
				return $element;
			}
		}

		return $fallback;
	}
}