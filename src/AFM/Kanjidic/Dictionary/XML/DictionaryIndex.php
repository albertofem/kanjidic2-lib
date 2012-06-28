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

use AFM\Kanjidic\Dictionary\DictionaryIndexInterface;

class DictionaryIndex implements DictionaryIndexInterface
{
	private $name;
	private $index;

	public function __construct($name, $index)
	{
		$this->name = $name;
		$this->index = $index;
	}

	public function setIndex($index)
	{
		$this->index = $index;
	}

	public function getIndex()
	{
		return $this->index;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}
}
