<?php
//require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$line = extractFileToString('input.txt');

$steps = explode(',', $line);

$values = 0;

foreach($steps as $index => $step) {
  $values += extractValues($step);
}


var_dump($values);

function extractValues ($step) {
  $value = 0;
  for($i = 0; $i < strlen($step); $i++) {
    $asciiValue = ord($step[$i]);

    $value += $asciiValue;
    $value *= 17;

    $value = $value % 256;
  }
  return $value;
}