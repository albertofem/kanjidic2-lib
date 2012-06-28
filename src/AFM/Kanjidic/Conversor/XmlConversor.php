<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

namespace AFM\Kanjidic\Conversor;

use AFM\Kanjidic\Dictionary;
use AFM\Kanjidic\Dictionary\XML;

/**
 * Parses and converts Xml kanjidic2 source file
 * to a valid Dictionary abstraction class
 *
 * @author Alberto <alberto@coolmobile.es>
 */
class XmlConversor
{
	private $file;

	/**
	 * @var \AFM\Kanjidic\Dictionary\DictionaryInterface
	 */
	private $dictionary;

	/**
	 * @var \SimpleXMLElement
	 */
	private $simpleXml;

	public function __construct($file)
	{
		$this->file = $file;
		$this->dictionary = new XML\Dictionary;
	}

	public function parse()
	{
		// init everythin

		$this->simpleXml = new \SimpleXMLElement(file_get_contents($this->file));

		$content = $this->simpleXml->children();

		foreach($content->character as $character)
		{
			$this->parseCharacter($character);
		}
	}

	public function getDictionary()
	{
		return $this->dictionary;
	}

	/**
	 * @param $element \SimpleXmlElement
	 */
	private function parseCharacter($character)
	{
		$entry = @$this->buildEntry($character);
		$this->dictionary->setEntry($entry);
	}

	private function buildEntry($character)
	{
		echo (string)$character->literal;

		$entry = new XML\Entry;
		$entry->setLiteral((string)$character->literal);
		$entry->setCodepoints($this->buildCodepoints($character->codepoint));
		$entry->setRadicals($this->buildRadicals($character->radical));
		$entry->setGrade((int)$character->misc->children()->grade);
		$entry->setStrokeCount((int)$character->misc->children()->stroke_count);
		$entry->setFrequency((int)$character->misc->children()->freq);
		$entry->setJlptLevel((int)$character->misc->children()->jlpt);
		$entry->setDictionaryIndexes($this->buildDictionaryIndexes($character->dic_number));
		$entry->setReadings($this->buildReadings($character->reading_meaning->children()->rmgroup->reading));
		$entry->setMeanings($this->buildMeanings($character->reading_meaning->children()->rmgroup->meaning));
		$entry->setNanories((array)$character->reading_meaning->children()->nanori);

		return $entry;
	}

	private function buildCodepoints($codepoints)
	{
		$cp = array();

		foreach($codepoints->children() as $codepoint)
		{
			$attr = $codepoint->attributes();
			$cp[] = new XML\Codepoint((string)$attr['cp_type'], (string)$codepoint);
		}

		return $cp;
	}

	private function buildRadicals($radicals)
	{
		$rad = array();

		foreach($radicals->children() as $radical)
		{
			$attr = $radical->attributes();
			$rad[] = new XML\Radical((int)$attr['rad_type'], (string)$radical);
		}

		return $rad;
	}

	private function buildDictionaryIndexes($dictionaries)
	{
		$dic = array();

		foreach($dictionaries->children() as $dictionary)
		{
			$attr = $dictionary->attributes();
			$dic[] = new XML\DictionaryIndex((string)$attr['dr_type'], (int)$dictionary);
		}

		return $dic;
	}

	private function buildReadings($readings)
	{
		$read = array();

		foreach($readings as $reading)
		{
			$attr = $reading->attributes();
			$read[] = new XML\Reading((string)$attr['r_type'], (string)$reading);
		}

		return $read;
	}

	private function buildMeanings($meanings)
	{
		$mean = array();

		foreach($meanings as $meaning)
		{
			$attr = $meaning->attributes();
			$mean[] = new XML\Meaning((string)$attr['m_lang'], (string)$meaning);
		}

		return $mean;
	}
}
