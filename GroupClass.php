<?php

// классы
require_once("CombinationClass.php");


// реализация класса
class Group
{
    // свойства
    private $combinations = []; // array of Combination: слова одной группы


    // методы
    public function __construct(array $group)
    {
        $combinations = array(); // array of Combination: содержит в себе комбинации

        foreach ($group as &$combination) {
            $combinations[] = new Combination($combination);
        }

        $this->combinations = $combinations;

        self::fixCombination();
    }

    public static function fromData(array $combinations)
    {
        $obj = new Group([]);
        $obj->combinations = $combinations;
        return $obj;
    }

    private function fixCombination()
    {
        $amount = count($this->combinations);

        for ($i = 0; $i < $amount - 1; $i++) {
            for ($j = $i + 1; $j < $amount; $j++){
                $curIn = $this->combinations[$i]->getInclude();
                $nextIn = $this->combinations[$j]->getInclude();

                $intersection = array_intersect($curIn, $nextIn);

                if (count($intersection)) {
                    $curAdd = array_diff($nextIn, $intersection);
                    $nextAdd = array_diff($curIn, $intersection);

                    $this->combinations[$i]->addExclude($curAdd);
                    $this->combinations[$j]->addExclude($nextAdd);
                }
            }
        }
    }

    public function getData()
    {
        return $this->combinations;
    }

    public function toStringArray() {
        $result = array();

        foreach ($this->combinations as &$combination) {
            $result[] = $combination->toString();
        }

        return $result;
    }
}