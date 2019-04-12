# Shom

## Summary
- [Description](#description)
- [Installation](#installation)
- [Usage](#usage)
- [API](#api)

## Description

Make a call to the shom text render api to collect data, put it in form and let you save it to a JSON file.

## Installation

On your PHP project, require the package:

```bash
composer require port-adhoc/shom:0.*
```

## Usage

- [Example 1: save marine data into a JSON file](#example-1-save-marine-data-into-a-json-file)

### Example 1: save marine data into a JSON file

In this example, we are saving marine data into a json file inside the same directory as our PHP script.

```php
// index.php
require __DIR__ . "/../vendor/autoload.php";

use PortAdhoc\Shom;

$shom = new Shom;

$shom->setSpot("Marseille")
    ->setLang("fr");
    ->setUtc(2);
    ->setFilePath("./marseille.json");

$shom->saveFile();
```

## API

- [`Shom->constructor()`](#constructor)
- [`Shom->setSpot()`](#setSpot)
- [`Shom->setLang()`](#setLang)
- [`Shom->setUtc()`](#setUtc)
- [`Shom->setFilePath()`](#setFilePath)
- [`Shom->saveFile()`](#saveFile)

### constructor

Creates a new instance of `PortAdhoc\Shom`.

```php
public function __construct();
```

### setSpot

Set the geodetic location to fetch the marine data from.

```php
/**
 * @throws InvalidArgumentException
 */
public function setSpot(string $spot): Shom;
```

### setLang

Set the lang in which to extract the data.

```php
/**
 * @throws InvalidArgumentException
 * @throws UnsupportedLangException
 */
public function setLang(string $lang): Shom;
```

### setUtc

Set the UTC.

```php
/**
 * @throws InvalidArgumentException
 */
public function setUtc(int $utc): Shom;
```

### SetFilePath

```php
/**
 * @throws InvalidArgumentException
 * @throws RuntimException
 */
public function setFilePath(string $filePath): Shom;
```

### saveFile

Save the file to the destination set using [`Shom->setFilePath`](#setFilePath)

```php
/**
 * @throws RuntimeException
 */
public function saveFile(): Shom;
```