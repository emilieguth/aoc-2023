<?php
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$winningChoices = [];

$times = extractData($lines[0], 5);
$distances = extractData($lines[1], 10);

for($i = 0; $i < count($times); $i++) {
  $time = $times[$i];
  $distance = $distances[$i];
  $winningChoices[$i] = 0;
  for($ms = 0; $ms < $time; $ms++) {
    $myDistance = max(0, ($time - $ms)) * $ms;
    if ($myDistance > $distance) {
      $winningChoices[$i] ++;
    }
  }
}
var_dump(array_product($winningChoices));

function extractData(string $line, int $offset): array {
  return array_values(array_map('intval', array_filter(explode(' ', trim(substr($line, $offset))))));
}