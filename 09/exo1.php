<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$lines = extractFileToArray('input.txt');

foreach($lines as $line) {
  $row = formatInput($line);
}

$extrapolatedValues = [];
foreach($lines as $line) {

  $row = formatInput($line);
  $treatedRow = treatRow($row);

  $value = 0;
  foreach($treatedRow as $row) {
    $value += end($row);
  }
  $extrapolatedValues[] = $value;
}
var_dump(array_sum($extrapolatedValues));
