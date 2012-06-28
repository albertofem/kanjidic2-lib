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

use AFM\Kanjidic\Dictionary\EntryInterface;
use AFM\Kanjidic\Dictionary\XML\Codepoint;

/**
 * {@inheritDoc}
 */
class Entry implements EntryInterface
{
	private $literal;
	private $codepoints;
	private $radicals;
	private $grade;
	private $strokeCount;
	private $frequency;
	private $dictionaryIndexes;
	private $readings;
	private $meanings;
	private $jlptLevel;
	private $nanories;

	public function setCodepoints(Array $codepoints)
	{
		$this->codepoints = $codepoints;
	}

	public function getCodepoints()
	{
		return $this->codepoints;
	}

	public function setDictionaryIndexes($dictionaryIndexes)
	{
		$this->dictionaryIndexes = $dictionaryIndexes;
	}

	public function getDictionaryIndexes()
	{
		return $this->dictionaryIndexes;
	}

	public function setFrequency($frequency)
	{
		$this->frequency = $frequency;
	}

	public function getFrequency()
	{
		return $this->frequency;
	}

	public function setGrade($grade)
	{
		$this->grade = $grade;
	}

	public function getGrade()
	{
		return $this->grade;
	}

	public function setLiteral($literal)
	{
		$this->literal = $literal;
	}

	public function getLiteral()
	{
		return $this->literal;
	}

	public function setMeanings($meanings)
	{
		$this->meanings = $meanings;
	}

	public function getMeanings()
	{
		return $this->meanings;
	}

	public function setRadicals($radicals)
	{
		$this->radicals = $radicals;
	}

	public function getRadicals()
	{
		return $this->radicals;
	}

	public function setReadings($readings)
	{
		$this->readings = $readings;
	}

	public function getReadings()
	{
		return $this->readings;
	}

	public function setStrokeCount($strokeCount)
	{
		$this->strokeCount = $strokeCount;
	}

	public function getStrokeCount()
	{
		return $this->strokeCount;
	}

	public function setJlptLevel($jlptLevel)
	{
		$this->jlptLevel = $jlptLevel;
	}

	public function getJlptLevel()
	{
		return $this->jlptLevel;
	}

	public function setNanories($nanories)
	{
		$this->nanories = $nanories;
	}

	public function getNanories()
	{
		return $this->nanories;
	}
}
