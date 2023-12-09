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
  $treatedRow = [$row];
  for ($i = 0; $i < count($row) -1; $i++) {
    $treatedRow[$i + 1] = computeRow($treatedRow[$i]);
    if (count(array_unique($treatedRow[$i + 1])) === 1) {
      break;
    }
  }
  $value = 0;
  foreach($treatedRow as $row) {
    $value += end($row);
  }
  $extrapolatedValues[] = $value;
}
var_dump(array_sum($extrapolatedValues));


function computeRow(array $row): array  {
  $newRow = [];
  for ($i = 0; $i < count($row) - 1; $i++) {
    $newRow[] = $row[$i+1] - $row[$i];
  }
  return $newRow;
}
