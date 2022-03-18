<?php
namespace KeyWordGenerator;


// классы
require_once("GroupClass.php");
require_once("CombinationClass.php");


// реализация класса
class Generator
{
    // свойства
    private $data; // Group


    // методы
    public function __construct(array $groups)
    {
        self::generate($groups);
    }

    private function generate(array $groups)
    {
        $n = count($groups);

        $result = $groups[0]; 
        for ($i = 1; $i < $n; $i++){
            $result = self::multiply($result, $groups[$i]);
        }

        $this->data = $result;
    }

    private function multiply(Group $a, Group $b)
    {
        $combinations = array();

        $aData = $a->getData();
        $bData = $b->getData();

        $aLen = count($aData);
        $bLen = count($bData);

        for ($i = 0; $i < $aLen; $i++) {
            for ($j = 0; $j < $bLen; $j++) {
                $aIn = $aData[$i]->getInclude();
                $aEx = $aData[$i]->getExclude();

                $bIn = $bData[$j]->getInclude();
                $bEx = $bData[$j]->getExclude();

                $buf = Combination::fromData([], []);

                $buf->addInclude($aIn);
                $buf->addInclude($bIn);
                
                $buf->addExclude($aEx);
                $buf->addExclude($bEx);

                $combinations[] = $buf;
            }
        }

        return Group::fromData($combinations);
    }

    public function getData()
    {
        return $this->data;
    }
}