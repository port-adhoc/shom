<?php

use PHPUnit\Framework\TestCase;
use PortAdhoc\Shom;

class SetLangTest extends TestCase {
    protected $shom;

    public function setUp(): void {
        $this->shom = new Shom;
    }

    public function testShouldThrowInvalidArgumentExceptionIfFirstParameterIsUnsupportedLang() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setLang("foo");
    }

    public function testShouldThrowInvalidArgumentExceptionIfFirstParameterEmpty() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setLang("");
    }

    public function testShouldCorrectlySetTheLang() {
        $spot = "fr";
        $expected = $spot;
        $actual = $this->shom->setLang($spot)->getLang();

        $this->assertEquals($expected, $actual);
    }
}