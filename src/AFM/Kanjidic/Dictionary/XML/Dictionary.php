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

/**
 * {@inheritDoc}
 */
class Dictionary implements DictionaryInterface
{
	/**
	 * @var Entry[]
	 */
	private $entries;

	/**
	 * @var int
	 */
	private $position = 0;

	/**
	 * @var array
	 */
	private $indexes = array();

    /**
     * Gets a literal entry from the dictionary
     *
     * @param $literal
     *
     * @return Entry
     */
	public function findByLiteral($literal)
	{
		return isset($this->entries[$literal]) ? $this->entries[$literal] : null;
	}

	/**
	 * Returns an array of every entry from the dictionary
	 *
	 * @return Entry[]
	 */
	public function findAll()
	{
		return $this->entries;
	}

	public function setEntry(Entry $entry)
	{
		$this->entries[$entry->getLiteral()] = $entry;
	}

	public function findByCodepoint($codePoint)
	{
        $data = $this->getIndexedData("codepointIndex", function()
        {
            $index = array();

            foreach($this->entries as $entry)
            {
                /** @var $entry \AFM\Kanjidic\Dictionary\EntryInterface */
                foreach($entry->getCodepoints() as $codePoint)
                {
                    /** @var $codePoint \AFM\Kanjidic\Dictionary\CodepointInterface */
                    if(!isset($index[$codePoint->getType()]))
                    {
                        $index[$codePoint->getType()] = array($this->entries[$entry->getLiteral()]);
                    }
                    else
                    {
                        array_push($index[$codePoint->getType()], $this->entries[$entry->getLiteral()]);
                    }
                }
            }

            return $index;
        });

        return isset($data[$codePoint]) ? $data[$codePoint] : array();
	}

    public function findByRadicalType($type)
    {
        $data = $this->getIndexedData("radicalTypeIndex", function()
        {
            $index = array();

            foreach($this->entries as $entry)
            {
                /** @var $entry \AFM\Kanjidic\Dictionary\EntryInterface */
                foreach($entry->getRadicals() as $radical)
                {
                    /** @var $radical \AFM\Kanjidic\Dictionary\RadicalInterface */
                    if(!isset($index[$radical->getType()]))
                    {
                        $index[$radical->getType()] = array($this->entries[$entry->getLiteral()]);
                    }
                    else
                    {
                        array_push($index[$radical->getType()], $this->entries[$entry->getLiteral()]);
                    }
                }
            }

            return $index;
        });

        return isset($data[$type]) ? $data[$type] : array();
    }

    public function findByRadical($type, $radicalValue)
    {
        $indexName = md5($type.$radicalValue);

        return $this->getIndexedData($indexName, function() use ($type, $radicalValue)
        {
            $index = array();

            foreach($this->entries as $entry)
            {
                /** @var $entry \AFM\Kanjidic\Dictionary\EntryInterface */
                foreach($entry->getRadicals() as $radical)
                {
                    /** @var $radical \AFM\Kanjidic\Dictionary\RadicalInterface */
                    if($radical->getType() != $type or $radical->getValue() != $radicalValue)
                        continue;

                    $index[] = $this->entries[$entry->getLiteral()];
                }
            }

            return $index;
        });
    }

    private function getIndexedData($index, callable $function)
    {
        if(!isset($this->indexes[$index]))
            $this->indexes[$index] = $function();

        return $this->indexes[$index];
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
