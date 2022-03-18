<?php

require_once("src/GroupClass.php");

use KeyWordGenerator\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    /**
     * @covers KeyWordGenerator\Group::__construct
     * @covers KeyWordGenerator\Group::fixCombination
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::addExclude
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::getInclude
     * @covers KeyWordGenerator\Combination::toString
     * @covers KeyWordGenerator\Group::toStringArray
     */
    public function testOne() : void
    {
        $obj = new Group(["Honda", "Honda CRF"]);
        $data = $obj->toStringArray();
        $this->assertEquals($data, ["Honda -CRF", "Honda CRF"]);
    }

    /**
     * @covers KeyWordGenerator\Group::__construct
     * @covers KeyWordGenerator\Group::fixCombination
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::addExclude
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::getInclude
     * @covers KeyWordGenerator\Combination::toString
     * @covers KeyWordGenerator\Group::toStringArray
     * @covers KeyWordGenerator\Group::fromData
     * @covers KeyWordGenerator\Group::getData
     */
    public function testTwo() : void
    {
        $obj1 = new Group(["Honda", "Honda CRF", "Honda CRF-450X"]);
        $obj2 = Group::fromData($obj1->getData());
        $this->assertEquals($obj1->getData(), $obj2->getData());

        $data = $obj1->toStringArray();
        $this->assertEquals($data, ["Honda -CRF -450X", "Honda CRF -450X", "Honda CRF 450X"]);
    }
}