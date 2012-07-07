<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

namespace AFM\Kanjidic\Tests;

use AFM\Kanjidic\Kanjidic;
use AFM\Kanjidic\Conversor\XmlConversor;
use AFM\Kanjidic\Dictionary;
use AFM\Kanjidic\Constant\Codepoint;
use AFM\Kanjidic\Dictionary\EntryInterface;

class KanjidicTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Kanjidic
	 */
	private static $kanjidic;

	public static function setUpBeforeClass()
	{
		$conversor = new XmlConversor(
			__DIR__.'/../src/AFM/Kanjidic/Resources/kanjidic2/kanjidic2-sample.xml', true
		);

		$conversor->parse();

		self::$kanjidic = new Kanjidic($conversor->getDictionary());
	}

	public function testLookByLiteralExists()
	{
		$kanji = self::$kanjidic->lookByLiteral('亜');

		$this->assertTrue($kanji instanceof Dictionary\EntryInterface);
	}

	/**
	 * @expectedException AFM\Kanjidic\Exception\LiteralNotFoundException
	 */
	public function testLookByLiteralNotFound()
	{
		self::$kanjidic->lookByLiteral('test');
	}

	public function testLookByCodepointExistsMultiple()
	{
		$result = self::$kanjidic->lookByCodepoint(Codepoint::JIS208);

		$this->assertTrue(is_array($result));
		$this->assertCount(2, $result);

		foreach($result as $entry)
		{
			$this->assertTrue($entry instanceof EntryInterface);
		}
	}

	public function testLookByCodepointExistsSingle()
	{
		$result = self::$kanjidic->lookByCodepoint(Codepoint::UCS);

		$this->assertTrue(is_array($result));
		$this->assertCount(2, $result);

		foreach($result as $entry)
		{
			$this->assertTrue($entry instanceof EntryInterface);
		}
	}
}
