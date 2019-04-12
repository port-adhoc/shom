<?php

require __DIR__ . "/../vendor/autoload.php";

use PortAdhoc\Shom;

$shom = new Shom;

$shom->setSpot("MARSEILLE")
    ->setLang("fr")
    ->setUtc(1)
    ->setFilePath("./marseille.json");

$shom->saveData();