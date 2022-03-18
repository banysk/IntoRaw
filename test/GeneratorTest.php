<?php

require_once("src/DataReaderClass.php");
require_once("src/GeneratorClass.php");

use KeyWordGenerator\DataReader;
use KeyWordGenerator\Group;
use KeyWordGenerator\Generator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    /**
     * @covers KeyWordGenerator\DataReader::__construct
     * @covers KeyWordGenerator\DataReader::readFromString
     * @covers KeyWordGenerator\DataReader::remakeData
     * @covers KeyWordGenerator\Group::toStringArray
     * @covers KeyWordGenerator\Combination::toString
     * @covers KeyWordGenerator\DataReader::getData
     * @covers KeyWordGenerator\Group::__construct
     * @covers KeyWordGenerator\Group::fixCombination
     * @covers KeyWordGenerator\Combination::__construct
     * @covers KeyWordGenerator\Combination::addExclude
     * @covers KeyWordGenerator\Combination::fixWord
     * @covers KeyWordGenerator\Combination::getInclude
     * @covers KeyWordGenerator\DataReader::getData
     * @covers KeyWordGenerator\Group::__construct
     * @covers KeyWordGenerator\Group::fixCombination
     * @covers KeyWordGenerator\Generator::__construct
     * @covers KeyWordGenerator\Generator::getData
     * @covers KeyWordGenerator\Generator::__construct
     * @covers KeyWordGenerator\Combination::addInclude
     * @covers KeyWordGenerator\Combination::fromData
     * @covers KeyWordGenerator\Combination::getExclude
     * @covers KeyWordGenerator\Generator::generate
     * @covers KeyWordGenerator\Generator::multiply
     * @covers KeyWordGenerator\Group::fromData
     * @covers KeyWordGenerator\Group::getData
     */
    public function testOne() : void
    {
        $obj = new DataReader(";", ", ");
        $inputStr = "Honda, Honda CRF;Приморский край -Владивосток";
        $obj->readFromString($inputStr);
        $obj->remakeData();
        $data = $obj->getData();
        
        $gen = new Generator($data);
        $data = $gen->getData();

        $result = $data->toStringArray();
        $expectedResult = [
            "Honda Приморский край -CRF -Владивосток",
            "Honda CRF Приморский край -Владивосток"
        ];

        $this->assertEquals($result, $expectedResult);
    }
}