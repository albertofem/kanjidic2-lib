# README

[![Build Status](https://secure.travis-ci.org/albertofem/kanjidic2-lib.png)](http://travis-ci.org/albertofem/kanjidic2-lib) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/albertofem/kanjidic2-lib/badges/quality-score.png?s=c6d93bef66310a21aca3fdcef7835afa3e1100ae)](https://scrutinizer-ci.com/g/albertofem/kanjidic2-lib/)

## Requirements

PHP >= 5.4

## Installation

In order to use this library on another project, you must add the kanjidic2 dictionary file as a Composer repository:

    "repositories": [
        {
            "type":"package",
            "package": {
                "name": "kanjidic2/kanjidic2",
                "version": "1.0",
                "dist": {
                    "url": "http://www.csse.monash.edu.au/~jwb/kanjidic2/kanjidic2.xml.gz",
                    "type": "file"
                }
            }
        }
    ],

Require this library using composer:

`composer require albertofem/kanjidic`

Install it:

`composer update albertofem/kanjidic`

Test everything is ok:

`php vendor/albertofem/kanjidic2-lib/bin/kanjidic kanjidic:dictionary:show vendor/kanjidic2/kanjidic2/kanjidic2.xml.gz`

You should see a large list of kanjis followed by the total count in the dictionary:

    ...

    縉繁署者臭艹艹著褐視謁謹賓贈辶逸難響頻

    Total dictionary entries: 13108

## Usage

Create new Kanjidic instance:

    <?php

    use AFM\Kanjidic\Kanjidic;

    $kanjidic = new Kanjidic("vendor/kanjidic2/kanjidic2/kanjidic2.xml.gz")

    $kanji = $kanjidic->lookByLiteral("世");

See `Kanjidic` class for more lookup methods

## License

This library is under the [MIT license](https://github.com/albertofem/kanjidic2-lib/blob/master/LICENSE).
