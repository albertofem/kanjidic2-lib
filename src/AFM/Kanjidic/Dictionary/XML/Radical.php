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

use AFM\Kanjidic\Dictionary\RadicalInterface;

class Radical implements RadicalInterface
{
	private $type;
	private $value;

	public function __construct($type, $value)
	{
		$this->type = $type;
		$this->value = $value;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}
}
