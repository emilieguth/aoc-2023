<?php

function extractFileToString($filename) {
  $fp = @fopen($filename, "r");
  if ($fp) {
    $buffer = fgets($fp, 25000);
    if (!feof($fp)) {
      echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
  }

  return trim($buffer);
}

function extractFileToArray($filename) {
  $lines = [];
  $fp = @fopen($filename, "r");
  if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
      $lines[] = trim($buffer);
    }
    if (!feof($fp)) {
      echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
  }

  return $lines;
}

function displayTable(array $table): void {
  foreach($table as $row) {
    foreach($row as $cell) {
      echo $cell ?? '.';
    }
    echo "\n";
  }
}
