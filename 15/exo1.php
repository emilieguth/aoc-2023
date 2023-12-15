<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$line = extractFileToString('input.txt');

$steps = explode(',', $line);

$values = 0;

foreach($steps as $index => $step) {
  $values += extractValues($step);
}


var_dump($values);
