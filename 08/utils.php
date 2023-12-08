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