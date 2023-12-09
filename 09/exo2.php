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
  for($i = count($treatedRow) - 1; $i >= 0; $i--) {
    if ($i === (count($treatedRow) - 1)) {
      $value = reset($treatedRow[$i]);
      continue;
    }
    $value = reset($treatedRow[$i]) - $value;
  }
  $extrapolatedValues[] = $value;
}
var_dump(array_sum($extrapolatedValues));

