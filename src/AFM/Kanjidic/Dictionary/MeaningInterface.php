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
 * Meanings of the dictionary entry
 */
interface MeaningInterface
{
	/**
	 * Returns language in ISO 3611-2 format
	 *
	 * @return string
	 */
	public function getLanguage();

	/**
	 * Get meaning
	 *
	 * @return string
	 */
	public function getMeaning();
}
