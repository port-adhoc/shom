<?php

use PHPUnit\Framework\TestCase;
use PortAdhoc\Shom;

class SetSpotTest extends TestCase {
    protected $shom;

    public function setUp(): void {
        $this->shom = new Shom;
    }

    public function testShouldThrowInvalidArgumentExceptionIfFirstParameterEmpty() {
        $this->expectException(InvalidArgumentException::class);

        $this->shom->setSpot("");
    }

    public function testShouldCorrectlySetTheSpot() {
        $spot = "foo";
        $expected = $spot;
        $actual = $this->shom->setSpot($spot)->getSpot();

        $this->assertEquals($expected, $actual);
    }
}