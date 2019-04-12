<?php

use PHPUnit\Framework\TestCase;
use PortAdhoc\Shom;

class ConstructorTest extends TestCase {
    protected $shom;

    public function setUp(): void {
        $this->shom = new Shom;
    }

    public function testShouldSetCorrectDefaultSpot() {
        $expected = "";
        $actual = $this->shom->getSpot();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldSetCorrectDefaultLang() {
        $expected = "fr";
        $actual = $this->shom->getLang();

        $this->assertEquals($expected, $actual);
    }

    public function testShouldSetCorrectDefaultUtc() {
        $expected = 0;
        $actual = $this->shom->getUtc();

        $this->assertEquals($expected, $actual);
    }
}