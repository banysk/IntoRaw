<?php

require_once("src/CombinationClass.php");

use KeyWordGenerator\Combination;
use PHPUnit\Framework\TestCase;

class CombinationTest extends TestCase
{
    /**
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::getInclude
     */
    public function testOne() : void
    {
        $obj = new Combination("Honda CRF");
        $data = $obj->getInclude();
        $this->assertEquals($data, ["Honda", "CRF"]);

        $obj = new Combination("Honda CRF-450X");
        $data = $obj->getInclude();
        $this->assertEquals($data, ["Honda", "CRF", "450X"]);
    }

    /**
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::toString
     */
    public function testTwo() : void
    {
        $obj = new Combination("a");
        $data = $obj->toString();
        $this->assertEquals($data, "+a");
    }

    /**
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::fromData
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::toString
     * @covers KeyWordGenerator\Combination::addInclude
     * @covers KeyWordGenerator\Combination::addExclude
     */
    public function testThree() : void
    {
        $obj = Combination::fromData([], []);
        $obj->addInclude(["Приморский", "край"]);
        $obj->addExclude(["Владивосток"]);
        $data = $obj->toString();
        $this->assertEquals($data, "Приморский край -Владивосток");
    }

    /**
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::getInclude
     * @covers KeyWordGenerator\Combination::getExclude
     */
    public function testFour() : void
    {
        $obj = new Combination("Приморский край -Владивосток");
        $data = [$obj->getInclude(), $obj->getExclude()];
        $this->assertEquals($data[0], ["Приморский", "край"]);
        $this->assertEquals($data[1], ["Владивосток"]);
    }
}