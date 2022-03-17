<?php
// классы
require_once("DataReaderClass.php");
require_once("GeneratorClass.php");

$reader = new DataReader(", ");
$reader->read("input.txt");

$reader->remakeData();
$data = $reader->getData();

$gen = new MyGenerator($data);
$text = $gen->getData()->toStringArray();

$outFile = fopen("output.txt", "w");

foreach ($text as $line) {
    fwrite($outFile, $line . "\n");
}

fclose($outFile);
