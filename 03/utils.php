<?php

function convertInputTo2DimArray($lines) {
  $input2DimArray = [];
  foreach ($lines as $line) {
    $lineParts = [];
    for ($i = 0; $i < strlen($line); $i++) {
      $lineParts[] = $line[$i];
    }
    $input2DimArray[] = $lineParts;
  }
  return $input2DimArray;
}

function isSurroundedBySymbol($input2DimArray, $line, $row) {
  return
    (checkIsSymbol($input2DimArray, $line - 1, $row - 1) === true
      or checkIsSymbol($input2DimArray, $line - 1, $row) === true
      or checkIsSymbol($input2DimArray, $line - 1, $row + 1) === true
      or checkIsSymbol($input2DimArray, $line, $row - 1) === true
      or checkIsSymbol($input2DimArray, $line, $row + 1) === true
      or checkIsSymbol($input2DimArray, $line + 1, $row - 1) === true
      or checkIsSymbol($input2DimArray, $line + 1, $row) === true
      or checkIsSymbol($input2DimArray, $line + 1, $row + 1) === true);
}

function checkIsSymbol($input2DimArray, $line, $row) {
  if (isset($input2DimArray[$line][$row]) === false) {
    return false;
  }
  if ($input2DimArray[$line][$row] === '.') {
    return false;
  }
  if (is_numeric($input2DimArray[$line][$row]) === true) {
    return false;
  }
  return true;
}

function getNumber($array, $line, $row) {
  if (isset($array[$line][$row]) === false) {
    return [null, null, null];
  }
  if (is_numeric($array[$line][$row]) === false) {
    return [null, null, null];
  }
  $value = $array[$line][$row];

  // On parse vers la gauche
  $continue = true;
  $currentRow = $row;
  while($continue) {
    $currentRow--;
    if(isset($array[$line][$currentRow]) && is_numeric($array[$line][$currentRow])) {
      $value = $array[$line][$currentRow].$value;
    } else {
      $continue = false;
    }
  }
  // On stocke la position de la première colonne
  $rowPosition = $currentRow;

  // On parse vers la droite
  $continue = true;
  $currentRow = $row;
  while($continue) {
    $currentRow++;
    if(isset($array[$line][$currentRow]) && is_numeric($array[$line][$currentRow])) {
      $value .= $array[$line][$currentRow];
    } else {
      $continue = false;
    }
  }

  return [$line, $rowPosition, $value];
}