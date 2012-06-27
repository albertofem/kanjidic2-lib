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
 * Represents a entry in the dictionary. All your entries
 * must implement this interface
 */
interface EntryInterface
{
	/**
	 * Gets kanji literal
	 *
	 * @return string
	 */
	public function getLiteral();

	/**
	 * Get array of codepoints
	 *
	 * @return CodepointInterface[]
	 */
	public function getCodepoints();

	/**
	 * Get radicals
	 *
	 * @return RadicalInterface
	 */
	public function getRadicals();

	/**
	 * Get grade
	 *
	 * @return int
	 */
	public function getGrade();

	/**
	 * Get stroke count
	 *
	 * @return int
	 */
	public function getStrokeCount();

	/**
	 * Gets frequency
	 *
	 * @return int
	 */
	public function getFrequency();

	/**
	 * Get JLPT official index
	 *
	 * @return int
	 */
	public function getJlptLevel();

	/**
	 * Gets dictionary indexes
	 *
	 * @return DictionaryIndexInterface
	 */
	public function getDictionaryIndexes();

	/**
	 * Get readings
	 *
	 * @return ReadingInterface
	 */
	public function getReadings();

	/**
	 * Get meanings
	 *
	 * @return MeaningInterface
	 */
	public function getMeanings();
}
