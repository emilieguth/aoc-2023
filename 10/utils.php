<?php
function formatRow(string $line): array {
  $row = [];
  for($i = 0; $i < strlen($line); $i++) {
    $row[] = $line[$i];
  }
  return $row;
}

function displayTable(array $table): void {
  foreach($table as $row) {
    foreach($row as $cell) {
      echo $cell ?? '.';
    }
    echo "\n";
  }
}