<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$thresholds = [12, 14, 13];

$possibleIds = [];
foreach ($lines as $line) {
  $draws = extractDraws($line);
  foreach ($draws as $draw) {
    if ($draw[0] > $thresholds[0] or $draw[1] > $thresholds[1] or $draw[2] > $thresholds[2]) {
      continue 2;
    }
  }
  $possibleIds[] = extractGameId($line);
}

var_dump(array_sum($possibleIds));

?>