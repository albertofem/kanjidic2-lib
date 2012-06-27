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

class Dictionary implements DictionaryInterface
{
	private $entries;

	/**
	 * Gets a literal entry in the dictionary
	 *
	 * @param string $character
	 *
	 * @return EntryInterface
	 */
	public function getEntry($literal)
	{
		return $this->entries[$literal];
	}

	/**
	 * Returns an array of every entry on the dictionary
	 *
	 * @return EntryInterface[]
	 */
	public function getEntries()
	{
		return $this->entries;
	}

	public function setEntry($element)
	{
		/** @var $entry Entry */
		$entry = new Entry;
		$entry->setLiteral($element->literal);
		$entry->setCodepoints($element->codepoint);


		$this->entries[$element->literal] = $entry;
	}
}
