<?php

/*
 * Copyright (c) 2014 Certadia, SL
 * All rights reserved
 */

namespace AFM\Kanjidic\Event;

use AFM\Kanjidic\Dictionary\XML\Entry;
use Symfony\Component\EventDispatcher\Event;

class ParserEntryEvent extends Event
{
    protected $entry;

    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    public function getEntry()
    {
        return $this->entry;
    }
} 