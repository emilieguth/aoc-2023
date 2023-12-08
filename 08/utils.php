<?php

function formatInput(array $lines): array {
  $nodes = [];
  foreach ($lines as $line) {
    [$start, $left, $right] = formatNode($line);
    $nodes[$start] = [
      'L' => $left,
      'R' => $right,
    ];
  }
  return $nodes;
}
function formatNode(string $node): array {
  $start = substr($node, 0, 3);
  $left = substr($node, 7, 3);
  $right = substr($node, 12, 3);
  return [$start, $left, $right];
}

function extractSteps(string $sequence, array $nodes, string $nextStep): int {
  $steps = 0;
  $found = false;
  while($found === false) {
    $direction = $sequence[$steps % strlen($sequence)];
    $nextStep = $nodes[$nextStep][$direction];
    $steps++;
    if (str_ends_with($nextStep, 'Z')) {
      $found = true;
    }
  }
  return $steps;
}