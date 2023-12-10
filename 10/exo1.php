<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';

$lines = extractFileToArray('input-example-1.txt');
$lines = extractFileToArray('input-example-2.txt');
$lines = extractFileToArray('input.txt');

$sketch = [];
$sketchCount = [];

foreach($lines as $row => $line) {
  $sketchRow = formatRow($line);
  $sketch[] = $sketchRow;
  foreach($sketchRow as $col => $value) {
    $sketchCount[$row][$col] = null;
  }
}

echo "sketch:\n";
displayTable($sketch);
echo "sketchCount:\n";
displayTable($sketchCount);

$firstPosition = findStartPosition($sketch);

$sketchCount[$firstPosition[0]][$firstPosition[1]] = 0;
findNextPosition($sketch, $firstPosition, $sketchCount);

echo "sketchCount:\n";
displayTable($sketchCount);

var_dump(findMax($sketchCount));

function findStartPosition(array $table): array {
  foreach($table as $row => $line) {
    foreach($line as $col => $value) {
      if ($value === 'S') {
        return [$row, $col];
      }
    }
  }
  return [];
}
function findNextPosition(array $table, $currentPosition, array &$sketchCount): void {
  [$row, $col] = $currentPosition;
  $currentTile = $table[$row][$col];
  $currentCount = $sketchCount[$row][$col] ?? 0;
  // Going down, on ne peut venir que d'en haut, l'une des cases suivantes : S | 7 F
  if (
    isset($table[$row + 1][$col])
    and in_array($currentTile, ['S', '|', '7', 'F'])
    and in_array($table[$row + 1][$col], ['|', 'L', 'J'])
    and ($sketchCount[$row + 1][$col] === null or $sketchCount[$row + 1][$col] > $currentCount + 1)
  ) {
    $sketchCount[$row + 1][$col] = $sketchCount[$row][$col] + 1;
    findNextPosition($table, [$row + 1, $col], $sketchCount);
  }

  // Going up, on ne peut venir que d'en bas, l'une des cases suivantes : S | L J
  if (
    isset($table[$row - 1][$col])
    and in_array($currentTile, ['S', '|', 'L', 'J'])
    and in_array($table[$row - 1][$col], ['7', 'F', '|'])
    and ($sketchCount[$row - 1][$col] === null or $sketchCount[$row - 1][$col] > $currentCount + 1)
  ) {
    $sketchCount[$row - 1][$col] = $sketchCount[$row][$col] + 1;
    findNextPosition($table, [$row - 1, $col], $sketchCount);
  }

  // Going right, on ne peut venir que de gauche, l'une des cases suivantes : S - L F
  if (
    isset($table[$row][$col + 1])
    and in_array($currentTile, ['S', '-', 'L', 'F'])
    and in_array($table[$row][$col + 1], ['-', '7', 'J'])
    and ($sketchCount[$row][$col + 1] === null or $sketchCount[$row][$col + 1] > $currentCount + 1)
  ) {
    $sketchCount[$row][$col + 1] = $sketchCount[$row][$col] + 1;
    findNextPosition($table, [$row, $col + 1], $sketchCount);
  }

  // Going left, on ne peut venir que de droite, l'une des cases suivantes : S - 7 J
  if (
    isset($table[$row][$col - 1])
    and in_array($currentTile, ['S', '-', '7', 'J'])
    and in_array($table[$row][$col - 1], ['-', 'L', 'F'])
    and ($sketchCount[$row][$col - 1] === null or $sketchCount[$row][$col - 1] > $currentCount + 1)
  ) {
    $sketchCount[$row][$col - 1] = $sketchCount[$row][$col] + 1;
    findNextPosition($table, [$row, $col - 1], $sketchCount);
  }
}

function findMax(array $table): int {
  $max = 0;
  foreach($table as $row) {
    foreach($row as $cell) {
      if ($cell !== null and $cell > $max) {
        $max = $cell;
      }
    }
  }
  return $max;
}