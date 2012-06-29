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

use AFM\Kanjidic\Dictionary\DictionaryInterface;
use AFM\Kanjidic\Dictionary\XML\Entry;
use AFM\Kanjidic\Conversor\XmlConversor;

/**
 * {@inheritDoc}
 */
class Dictionary implements DictionaryInterface, \Countable
{
	/**
	 * @var Entry
	 */
	private $entries;

	/**
	 * If you pass the kanjidic2 xml source file to this
	 * constructor, a new dictionary will be converted from it
	 * and returned instead of an empty object
	 *
	 * @param string $file
	 */
	public function __construct($file = null)
	{
		if(is_null($file))
			return $this;

		// parse a new dictionary and return it
		$conversor = new XmlConversor($file);
		$conversor->parse();

		return $conversor->getDictionary();
	}

	/**
	 * Gets a literal entry from the dictionary
	 *
	 * @param string $character
	 *
	 * @return Entry
	 */
	public function getEntry($literal)
	{
		return isset($this->entries[$literal]) ? $this->entries[$literal] : null;
	}

	/**
	 * Returns an array of every entry from the dictionary
	 *
	 * @return Entry[]
	 */
	public function getEntries()
	{
		return $this->entries;
	}

	public function setEntry(Entry $entry)
	{
		$this->entries[$entry->getLiteral()] = $entry;
	}

	/**
	 * {@inheritDoc}
	 */
	public function count()
	{
		return count($this->entries);
	}
}
