<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$powers = [];
foreach ($lines as $line) {
  $draws = extractDraws($line);
  $mins = [0, 0, 0];
  foreach ($draws as $draw) {
    foreach($mins as $index => $min) {
      if ($draw[$index] > $min) {
        $mins[$index] = $draw[$index];
      }
    }
  }
  $powers[] = array_product($mins);
}

var_dump(array_sum($powers));
?>