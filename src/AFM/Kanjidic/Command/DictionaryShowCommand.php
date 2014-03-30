<?php

/*
 * Copyright (c) 2014 Certadia, SL
 * All rights reserved
 */

namespace AFM\Kanjidic\Command;

use AFM\Kanjidic\Event\ParserEntryEvent;
use AFM\Kanjidic\Events;
use AFM\Kanjidic\Kanjidic;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DictionaryShowCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('kanjidic:dictionary:show')
            ->setDescription('Shows dictionary contents and stats')
            ->addArgument("file", InputArgument::REQUIRED, "Location of kanjidic2.xml file")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $kanjidic = new Kanjidic($input->getArgument("file"), false);

        $kanjidic->getEventDispatcher()->addListener(Events::PARSER_ENTRY, function(ParserEntryEvent $event) use ($output)
        {
            $entry = $event->getEntry();

            $output->write($entry->getLiteral());
        });

        $output->writeln("\n\nTotal dictionary entries: <info>" .count($kanjidic->getDictionary()). "</info>");
    }
}