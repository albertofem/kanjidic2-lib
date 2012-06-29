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
 * Your dictionary must implement this interface in
 * order to work with the kanjidic lookup library
 */
interface DictionaryInterface extends \ArrayAccess, \Iterator, \Countable
{
	/**
	 * Gets a literal entry in the dictionary
	 *
	 * @param string $character
	 *
	 * @return EntryInterface
	 */
	public function getEntry($literal);

	/**
	 * Returns an array of every entry on the dictionary
	 *
	 * @return EntryInterface[]
	 */
	public function getEntries();
}
