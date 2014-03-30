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

use AFM\Kanjidic\Constant\Radical;
use AFM\Kanjidic\Kanjidic;
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
		self::$kanjidic = new Kanjidic(__DIR__.'/Resources/kanjidic2-sample.xml');
	}

	public function testLookByLiteralExists()
	{
		$kanji = self::$kanjidic->lookByLiteral('亜');

		$this->assertTrue($kanji instanceof Dictionary\EntryInterface);
	}

	/**
	 * @expectedException \AFM\Kanjidic\Exception\LiteralNotFoundException
	 */
	public function testLookByLiteralNotFound()
	{
		self::$kanjidic->lookByLiteral('test');
	}

	public function testLookByCodepointExistsMultiple()
	{
		$result = self::$kanjidic->lookByCodepoint(Codepoint::JIS208);

        $this->assertDicEntries($result, 2);
	}

	public function testLookByCodepointExistsSingle()
	{
		$result = self::$kanjidic->lookByCodepoint(Codepoint::UCS);

        $this->assertDicEntries($result, 2);
	}

    public function testLookByRadicalTypeClassical()
    {
        $result = self::$kanjidic->lookByRadicalType(Radical::CLASSICAL);

        $this->assertDicEntries($result, 2);
    }

    public function testLookByRadicalTypeNelsonC()
    {
        $result = self::$kanjidic->lookByRadicalType(Radical::NELSON_C);

        $this->assertDicEntries($result, 1);
    }

    public function testLookByRadical()
    {
        $result = self::$kanjidic->lookByRadical(Radical::CLASSICAL, 7);

        $this->assertDicEntries($result, 1);

        $result = self::$kanjidic->lookByRadical(Radical::CLASSICAL, 30);

        $this->assertDicEntries($result, 1);
    }

    private function assertDicEntries($result, $expectedCount)
    {
        $this->assertTrue(is_array($result));
        $this->assertCount($expectedCount, $result);

        foreach($result as $entry)
        {
            $this->assertTrue($entry instanceof EntryInterface);
        }
    }
}
