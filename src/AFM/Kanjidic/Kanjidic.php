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
use Symfony\Component\EventDispatcher\EventDispatcher;

class Kanjidic
{
	/**
	 * @var \AFM\Kanjidic\Dictionary\DictionaryInterface
	 */
	protected $dictionary;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

	const CRITERIA_EQUAL = "=";
	const CRITERIA_GT = ">";
	const CRITERIA_LW = "<";
	const CRITERIA_GTE = ">=";
	const CRITERIA_LTW = "<=";

	public function __construct($file, $parse = true)
	{
        $this->file = $file;

        if($parse)
		    $this->parseDictionary();
	}

    public function getDictionary()
    {
        if(!$this->dictionary)
            $this->parseDictionary();

        return $this->dictionary;
    }

    protected function parseDictionary()
    {
        $parser = new Parser($this->file, $this->getEventDispatcher());
        $this->dictionary = $parser->parse();
    }

	public function lookByLiteral($literal)
	{
		$entry = $this->getDictionary()->findByLiteral($literal);

		if(is_null($entry))
			throw new Exception\LiteralNotFoundException;

		return $entry;
	}

	public function lookByCodepoint($codePoint)
	{
		return $this->getDictionary()->findByCodepoint($codePoint);
	}

	public function lookByRadicalType($type)
	{
        return $this->getDictionary()->findByRadicalType($type);
	}

    public function lookByRadical($type, $radical)
    {
        return $this->getDictionary()->findByRadical($type, $radical);
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

    public function getEventDispatcher()
    {
        if(!$this->eventDispatcher)
            $this->eventDispatcher = new EventDispatcher();

        return $this->eventDispatcher;
    }
}