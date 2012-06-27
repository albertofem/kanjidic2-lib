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

class Kanjidic
{
	private $source;

	const CODEPOINT_UCS = "ucs";
	const CODEPOINT_TYPE = "jis208";

	const RADICAL_CLASSICA = "classical";

	const CRITERIA_EQUAL = "=";
	const CRITERIA_GT = ">";
	const CRITERIA_LW = "<";
	const CRITERIA_GTE = ">=";
	const CRITERIA_LTW = "<=";

	const DICTIONARY_NELSON_C = "nelson_c";
	const DICTIONARY_NELSON_N = "nelson_n";
	const DICTIONARY_HALPERN_NJECD = "halpern_njecd";
	const DICTIONARY_HALPERN_KKLD = "nelson_c";
	const DICTIONARY_HEISIG = "heisig";
	const DICTIONARY_GAKKEN = "gakken";
	const DICTIONARY_ONEILL_NAMES = "oneill_names";
	const DICTIONARY_ONEILL_KK = "oneill_kk";

	public function __construct($fileSource)
	{
		$this->source = $fileSource;
	}

	public function lookByLiteral($value)
	{

	}

	public function lookByCodepoint($codePoint, $value)
	{

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

	public function lookByJlptIndex($index)
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
}