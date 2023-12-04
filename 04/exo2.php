<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input-example.txt');

$scratchCards = [];

foreach ($lines as $index => $line) {
  [$cardId, $winningNumbers, $myNumbers] = extractScratchCards($line);
  $scratchCards[$cardId] = isset($scratchCards[$cardId]) ? $scratchCards[$cardId] + 1 : 1;

  $myWinningNumbers = array_intersect($winningNumbers, $myNumbers);
  $countWinningNumbers = count($myWinningNumbers);
  $copiesOfCurrentCardId = $scratchCards[$cardId] ?? 0;

  for ($copy = 1; $copy < $copiesOfCurrentCardId + 1; $copy++) {
    for ($i = 1; $i < $countWinningNumbers + 1; $i++) {
      if (isset($scratchCards[$cardId + $i]) === false) {
        $scratchCards[$cardId + $i] = 1;
      } else {
        $scratchCards[$cardId + $i]++;
      }
    }
  }
}

var_dump(array_sum($scratchCards));
