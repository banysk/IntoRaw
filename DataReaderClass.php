<?php

// классы
require_once("GroupClass.php");
require_once("CombinationClass.php");


// реализация класса
class DataReader
{
    // свойства
    private $combinationSeparator; // string: разделитель для словосочетаний
    private $groups = []; // array of Group


    // методы
    public function __construct(string $combinationSeparator)
    {
        $this->combinationSeparator = $combinationSeparator;
    }

    public function read(string $fileName)
    {
        $resourse = fopen($fileName, "r");

        $groups = array();

        while (!feof($resourse)) {
            $groups[] = explode(
                $this->combinationSeparator, str_replace("\n", "", fgets($resourse))
            );
        }

        fclose($resourse);

        $this->groups = $groups;
    }

    public function remakeData()
    {
        $groups = array(); // array of Groups: хранит в себе Group, которые содержат в себе Combination

        foreach ($this->groups as &$group) {
            $groups[] = new Group($group);
        }

        $this->groups = $groups;
    }

    public function getData()
    {
        return $this->groups;
    }
}