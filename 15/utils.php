<?php
function extractValues (string $step): int {
  $value = 0;
  for($i = 0; $i < strlen($step); $i++) {
    $asciiValue = ord($step[$i]);

    $value += $asciiValue;
    $value *= 17;

    $value = $value % 256;
  }
  return (int)$value;
}

function extractBoxNumber (string $step): int {
  $value = 0;
  for($i = 0; $i < strlen($step); $i++) {
    if ($step[$i] === '-' || $step[$i] === '=') {
      break;
    }
    $asciiValue = ord($step[$i]);

    $value += $asciiValue;
    $value *= 17;

    $value = $value % 256;
  }
  return (int)$value;
}
