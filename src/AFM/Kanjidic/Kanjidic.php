<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

namespace AFM\Kanjidic;

use AFM\Kanjidic\Constant;
use AFM\Kanjidic\Dictionary\DictionaryInterface;
use AFM\Kanjidic\Exception;

/**
 * Kanjidic lookup class
 *
 * @author Alberto <alberto@coolmobile.es>
 */
class Kanjidic
{
	/**
	 * @var \AFM\Kanjidic\Dictionary\DictionaryInterface
	 */
	private $dictionary;

	const CRITERIA_EQUAL = "=";
	const CRITERIA_GT = ">";
	const CRITERIA_LW = "<";
	const CRITERIA_GTE = ">=";
	const CRITERIA_LTW = "<=";

	public function __construct(DictionaryInterface $dictionary = null)
	{
		$this->dictionary = $dictionary;
	}

	public function lookByLiteral($literal)
	{
		$entry = $this->dictionary->getEntry($literal);

		if(is_null($entry))
			throw new Exception\LiteralNotFoundException;

		return $entry;
	}

	public function lookByCodepoint($codePoint)
	{
		return $this->dictionary->getCodepointEntries($codePoint);
	}

	public function lookByRadical($type, $value)
	{
	}

	public function lookByGrade($grade)
	{
	}

	public function lookByStrokeCount($criteria = self::CRITERIA_EQUAL,
		$strokeCount, $strokeCountRight = null)
	{
	}

	public function lookByFrequency($criteria = self::CRITERIA_EQUAL, $frequency,
		$frenquencyRight = null)
	{
	}

	public function lookByJlptLevel($level)
	{
	}

	public function lookByDictionaryIndex($dictionary, $index)
	{
	}

	public function lookByReading($type, $reading)
	{
	}

	public function lookByReadings(Array $readings)
	{
	}

	public function lookByMeaning($language, $meaning)
	{
	}

	public function lookByMeanings(Array $meanings)
	{
	}

	/**
	 * @param \AFM\Kanjidic\Dictionary\DictionaryInterface $dictionary
	 */
	public function setDictionary(DictionaryInterface $dictionary)
	{
		$this->dictionary = $dictionary;
	}

	/**
	 * @return \AFM\Kanjidic\Dictionary\DictionaryInterface
	 */
	public function getDictionary()
	{
		return $this->dictionary;
	}
}