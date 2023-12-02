<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input-example.txt');

$red = 12;
$blue = 14;
$green = 13;

$possibleIds = [];
foreach ($lines as $line) {
  $id = extractGameId($line);
  $draws = extractDraws($line);
  $isPossible = true;
  foreach ($draws as $draw) {
    if ($draw[0] > $red or $draw[1] > $blue or $draw[2] > $green) {
      $isPossible = false;
    }
  }
  if ($isPossible) {
    $possibleIds[] = $id;
  }
}

var_dump(array_sum($possibleIds));

?>