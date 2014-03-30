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
     * Returns an array of every entry on the dictionary
     *
     * @return EntryInterface[]
     */
    public function findAll();

    /**
     * Gets a literal entry in the dictionary
     *
     * @param $literal
     *
     * @return EntryInterface
     */
	public function findByLiteral($literal);

	public function findByCodepoint($codePoint);

    public function findByRadicalType($radicalType);

    public function findByRadical($type, $radical);
}
