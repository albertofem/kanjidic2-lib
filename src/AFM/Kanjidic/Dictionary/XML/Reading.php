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

use AFM\Kanjidic\Dictionary\ReadingInterface;

class Reading implements ReadingInterface
{
	private $type;
	private $reading;

	public function __construct($type, $reading)
	{
		$this->type = $type;
		$this->reading = $reading;
	}

	public function setReading($reading)
	{
		$this->reading = $reading;
	}

	public function getReading()
	{
		return $this->reading;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}
}
