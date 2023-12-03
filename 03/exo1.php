<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$input2DimArray = convertInputTo2DimArray($lines);

$partNumbers = [];
$isPartNumber = false;

foreach ($input2DimArray as $line => $cells) {
  $currentNumber = '';

  foreach ($cells as $row => $cell) {

    if (is_numeric($cell) === false) {

      if ($isPartNumber === true) {
        $partNumbers[] = (int)$currentNumber;
      }

      $currentNumber = '';
      $isPartNumber = false;

    } else {

      $currentNumber .= $cell;

      if (isSurroundedBySymbol($input2DimArray, $line, $row) === true) {
        $isPartNumber = true;
      }

    }

    // En cas de fin de ligne
    if ($row === count($cells) - 1 and $isPartNumber === true) {
      $partNumbers[] = (int)$currentNumber;
    }
  }
}

var_dump(array_sum($partNumbers));