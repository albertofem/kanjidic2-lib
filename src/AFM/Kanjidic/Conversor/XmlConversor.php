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
	}

	public function parse()
	{
		// init everythin

		$this->simpleXml = new \SimpleXMLElement(file_get_contents($this->file));

		$content = $this->simpleXml->children();

		foreach($content->character as $character)
		{
			$this->parseXmlElement($character);
		}
	}

	public function getDictionary()
	{
		return $this->dictionary;
	}

	/**
	 * @param $element \SimpleXmlElement
	 */
	private function parseXmlElement($element)
	{
		print_r($element);
	}
}
