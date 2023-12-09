<?php

function formatInput(string $line): array {
  return array_values(array_map('intval', explode(' ', $line)));
}

function computeRow(array $row): array  {
  $newRow = [];
  for ($i = 0; $i < count($row) - 1; $i++) {
    $newRow[] = $row[$i+1] - $row[$i];
  }
  return $newRow;
}

function treatRow(array $row): array {
  $treatedRow = [$row];
  for ($i = 0; $i < count($row) -1; $i++) {
    $treatedRow[$i + 1] = computeRow($treatedRow[$i]);
    if (count(array_unique($treatedRow[$i + 1])) === 1) {
      break;
    }
  }
  return $treatedRow;
}