<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$totalScore = 0;

foreach($lines as $line) {
  [$cardId, $winningNumbers, $myNumbers] = extractScratchCards($line);
  $myWinningNumbers = array_intersect($winningNumbers, $myNumbers);

  if (count($myWinningNumbers) === 0) {
    $score = 0;
  } else {
    $score = max(0, pow(2, (count($myWinningNumbers) - 1)));
  }
  $totalScore += $score;
}

var_dump($totalScore);