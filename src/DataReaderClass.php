<?php
namespace KeyWordGenerator;


// классы
require_once("GroupClass.php");
require_once("CombinationClass.php");


// реализация класса
class DataReader
{
    // свойства
    private $groupSeparator; // string: разделитель для групп
    private $combinationSeparator; // string: разделитель для словосочетаний
    private $groups = []; // array of Group


    // методы
    public function __construct(string $groupSeparator, string $combinationSeparator)
    {
        $this->groupSeparator = $groupSeparator;
        $this->combinationSeparator = $combinationSeparator;
    }

    public function readFromFile(string $fileName)
    {
        $resourse = fopen($fileName, "r");

        $groups = array();

        while (!feof($resourse)) {
            $groups[] = explode(
                $this->combinationSeparator, str_replace($this->groupSeparator, "", fgets($resourse))
            );
        }

        fclose($resourse);

        $this->groups = $groups;
    }

    public function readFromString(string $data)
    {
        $groups = explode($this->groupSeparator, $data);

        foreach ($groups as &$combination) {
            $combination = explode($this->combinationSeparator, $combination);
        }

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

    public function getData() // default, DON'T TEST
    {
        return $this->groups;
    }
}