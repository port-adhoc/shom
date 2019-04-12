<?php

use PHPUnit\Framework\TestCase;
use PortAdhoc\Shom;

class SetUtcTest extends TestCase {
    protected $shom;

    public function setUp(): void {
        $this->shom = new Shom;
    }

    public function testShouldThrowInvalidArgumentExceptionIfUtcNotValid() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setUtc(99);
    }

    public function testShouldCorrectlySetUtc() {
        $utc = 1;
        $expected = $utc;
        $actual = $this->shom->setUtc($utc)->getUtc();

        $this->assertEquals($expected, $actual);
    }
}