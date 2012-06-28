<?php

/*
 * This file is part of the kanjidic2-lib
 *
 * (c) Alberto Fernández <albertofem@gmail.com>
 *
 * For the full copyright and license information, please read
 * the LICENSE file that was distributed with this source code.
 */

require_once '/usr/share/php/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
	'AFM' =>  __DIR__ . '/src/'
));

$loader->register();

use AFM\Kanjidic\Conversor\XmlConversor;

$conversor = new XmlConversor(__DIR__.'/src/AFM/Kanjidic/Resources/kanjidic2/kanjidic2.xml');

$conversor->parse();
$dictionary = $conversor->getDictionary();

var_dump($dictionary->getEntry('唖'));