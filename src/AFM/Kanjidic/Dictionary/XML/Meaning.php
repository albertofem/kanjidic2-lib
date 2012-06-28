<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

namespace AFM\Kanjidic\Dictionary\XML;

use AFM\Kanjidic\Dictionary\MeaningInterface;

class Meaning implements MeaningInterface
{
	private $language;
	private $meaning;

	public function __construct($language, $meaning)
	{
		$this->language = empty($language) ? 'en' : $language;
		$this->meaning = $meaning;
	}

	public function setLanguage($language)
	{
		$this->language = $language;
	}

	public function getLanguage()
	{
		return $this->language;
	}

	public function setMeaning($meaning)
	{
		$this->meaning = $meaning;
	}

	public function getMeaning()
	{
		return $this->meaning;
	}
}
