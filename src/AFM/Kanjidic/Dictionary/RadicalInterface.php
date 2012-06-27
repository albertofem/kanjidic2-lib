<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

namespace AFM\Kanjidic\Dictionary;

/**
 * Represents the radical of the dicitionary entry
 */
interface RadicalInterface
{
	/**
	 * @abstract
	 * @return mixed
	 */
	public function getType();

	/**
	 * @abstract
	 * @return mixed
	 */
	public function getValue();
}