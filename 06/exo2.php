<?php
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');
$winningChoices = 0;

$time = extractData($lines[0], 5);
$distance = extractData($lines[1], 10);

for($ms = 0; $ms < $time; $ms++) {
  $myDistance = max(0, ($time - $ms)) * $ms;
  if ($myDistance > $distance) {
    $winningChoices++;
  }
}
var_dump($winningChoices);

function extractData(string $line, int $offset): int {
  return (int)str_replace(' ', '', substr($line, $offset));
}