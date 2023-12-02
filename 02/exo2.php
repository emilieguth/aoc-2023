<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$red = 12;
$blue = 14;
$green = 13;

$powers = [];
foreach ($lines as $line) {
  $id = extractGameId($line);
  $draws = extractDraws($line);
  $minRed = 0;
  $minBlue = 0;
  $minGreen = 0;
  foreach ($draws as $draw) {
    if ($draw[0] > $minRed) {
      $minRed = $draw[0];
    }
    if ($draw[1] > $minBlue) {
      $minBlue = $draw[1];
    }
    if ($draw[2] > $minGreen) {
      $minGreen = $draw[2];
    }
  }
  $powers[] = $minRed * $minBlue * $minGreen;
}

var_dump(array_sum($powers));
?>