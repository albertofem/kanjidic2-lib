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
class Dictionary implements DictionaryInterface
{
	/**
	 * @var Entry
	 */
	private $entries;

	/**
	 * @var int
	 */
	private $position = 0;

	/**
	 * @var array
	 */
	private $codePointIndex = array();

	/**
	 * If you pass the kanjidic2 xml source file to this
	 * constructor, a new dictionary will be converted from it
	 * and returned instead of an empty object, testdsdsd
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

	public function getCodepointEntries($codePoint)
	{
		if(empty($this->codePointIndex))
			$this->buildCodepointIndex();

		return $this->codePointIndex[$codePoint];
	}

	private function buildCodepointIndex()
	{
		foreach($this->entries as $entry)
		{
			/** @var $entry \AFM\Kanjidic\Dictionary\EntryInterface */
			foreach($entry->getCodepoints() as $codePoint)
			{
				/** @var $codePoint \AFM\Kanjidic\Dictionary\CodepointInterface */
				if(!isset($this->codePointIndex[$codePoint->getType()]))
				{
					$this->codePointIndex[$codePoint->getType()] = array($this->entries[$entry->getLiteral()]);
				}
				else
				{
					array_push($this->codePointIndex[$codePoint->getType()], $this->entries[$entry->getLiteral()]);
				}
			}
		}
	}

	/**
	 * {@inheritDoc}
	 */
	public function count()
	{
		return count($this->entries);
	}

	/**
	 * {@inheritDoc}
	 */
	public function current()
	{
		$positions = array_keys($this->entries);

		return $this->entries[$positions[$this->position]];
	}

	/**
	 * {@inheritDoc}
	 */
	public function next()
	{
		$this->position++;
	}

	/**
	 * {@inheritDoc}
	 */
	public function key()
	{
		$positions = array_keys($this->entries);

		return $positions[$this->position];
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid()
	{
		$positions = array_keys($this->entries);

		return isset($this->entries[$positions[$this->position]]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function rewind()
	{
		$this->position = 0;
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetExists($offset)
	{
		return isset($this->entries[$offset]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetGet($offset)
	{
		return $this->entries[$offset];
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetSet($offset, $value)
	{
		if(!$value instanceof Entry)
			throw new \InvalidArgumentException('Value must be of type AFM\Kanjidic\Dictionary\XML\Entry');

		$this->entries[$offset] = $value;
	}

	/**
	 * {@inheritDoc}
	 */
	public function offsetUnset($offset)
	{
		unset($this->entries[$offset]);
	}
}
