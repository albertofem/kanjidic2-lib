<?php

/*
 * Copyright (c) 2014 Certadia, SL
 * All rights reserved
 */

namespace AFM\Kanjidic;

use AFM\Kanjidic\Dictionary\XML;
use AFM\Kanjidic\Event\ParserEntryEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Parser
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var \AFM\Kanjidic\Dictionary\DictionaryInterface
     */
    protected $dictionary;

    /**
     * @var \SimpleXMLElement
     */
    private $simpleXml;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    public function __construct($file, EventDispatcher $eventDispatcher)
    {
        $this->file = $file;
        $this->dictionary = new XML\Dictionary();
        $this->eventDispatcher = $eventDispatcher;
    }

    public function parse()
    {
        $this->simpleXml = new \SimpleXMLElement(file_get_contents($this->file));
        $content = $this->simpleXml->children();

        foreach($content->character as $character)
        {
            $this->parseCharacter($character);
        }

        return $this->dictionary;
    }

    /**
     * @param $character \SimpleXmlElement
     */
    protected function parseCharacter($character)
    {
        $entry = @$this->buildEntry($character);
        $this->dictionary->setEntry($entry);
    }

    private function buildEntry($character)
    {
        $entry = new XML\Entry;
        $entry->setLiteral((string)$character->literal);
        $entry->setCodepoints($this->buildCodepoints($character->codepoint));
        $entry->setRadicals($this->buildRadicals($character->radical));
        $entry->setGrade((int)$character->misc->children()->grade);
        $entry->setStrokeCount((int)$character->misc->children()->stroke_count);
        $entry->setFrequency((int)$character->misc->children()->freq);
        $entry->setJlptLevel((int)$character->misc->children()->jlpt);
        $entry->setDictionaryIndexes($this->buildDictionaryIndexes($character->dic_number));
        $entry->setReadings($this->buildReadings($character->reading_meaning->children()->rmgroup->reading));
        $entry->setMeanings($this->buildMeanings($character->reading_meaning->children()->rmgroup->meaning));
        $entry->setNanories((array)$character->reading_meaning->children()->nanori);

        $this->eventDispatcher->dispatch(Events::PARSER_ENTRY, new ParserEntryEvent($entry));

        return $entry;
    }

    private function buildCodepoints($codepoints)
    {
        $cp = array();

        foreach($codepoints->children() as $codepoint)
        {
            $attr = $codepoint->attributes();
            $cp[] = new XML\Codepoint((string)$attr['cp_type'], (string)$codepoint);
        }

        return $cp;
    }

    private function buildRadicals($radicals)
    {
        $rad = array();

        foreach($radicals->children() as $radical)
        {
            $attr = $radical->attributes();
            $rad[] = new XML\Radical((string)$attr['rad_type'], (string)$radical);
        }

        return $rad;
    }

    private function buildDictionaryIndexes($dictionaries)
    {
        $dic = array();

        foreach($dictionaries->children() as $dictionary)
        {
            $attr = $dictionary->attributes();
            $dic[] = new XML\DictionaryIndex((string)$attr['dr_type'], (int)$dictionary);
        }

        return $dic;
    }

    private function buildReadings($readings)
    {
        $read = array();

        foreach($readings as $reading)
        {
            $attr = $reading->attributes();
            $read[] = new XML\Reading((string)$attr['r_type'], (string)$reading);
        }

        return $read;
    }

    private function buildMeanings($meanings)
    {
        $mean = array();

        foreach($meanings as $meaning)
        {
            $attr = $meaning->attributes();
            $mean[] = new XML\Meaning((string)$attr['m_lang'], (string)$meaning);
        }

        return $mean;
    }

    public function createDictionary()
    {
        return new XML\Dictionary();
    }

    public function getDictionary()
    {
        return $this->dictionary;
    }
} 