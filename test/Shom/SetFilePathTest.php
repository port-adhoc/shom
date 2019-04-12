<?php

use PHPUnit\Framework\TestCase;
use PortAdhoc\Shom;

class SetFilePathTest extends TestCase {
    protected $shom;

    public function setUp(): void {
        $this->shom = new Shom;
    }

    public function testShouldThrowInvalidArgumentExceptionIfFirstParameterEmpty() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setFilePath("");
    }

    public function testShouldThrowInvalidArgumentExceptionIfFirstParameterIsDirectory() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setFilePath(__DIR__ . "/../Shom");
    }

    public function testShouldCorrectlySetFilePath() {
        $filePath = __DIR__ . "/../../composer.json";
        $expected = $filePath;
        $actual = $this->shom->setFilePath($filePath)->getFilePath();

        $this->assertEquals($expected, $actual);
    }
}