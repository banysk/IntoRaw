<?php 
namespace KeyWordGenerator;


// классы
require_once("lib\DataReaderClass.php");
require_once("lib\GeneratorClass.php");

// str for test
$str = "Honda, Honda CRF, Honda CRF-450X;Владивосток, Приморский край -Владивосток;продажа, покупка, цена, с пробегом";

$reader = new DataReader(";", ", ");
$reader->readFromString($str);

$reader->remakeData();
$data = $reader->getData();

$gen = new MyGenerator($data);
$text = $gen->getData()->toStringArray();

$outFile = fopen("txt/output.txt", "w");

foreach ($text as $line) {
    fwrite($outFile, $line . "\n");
}

fclose($outFile);
