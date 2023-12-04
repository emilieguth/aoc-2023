<?php
function extractScratchCards(string $line) {
  $cardId = (int)substr($line, 5, strpos($line, ':') - strlen($line));

  $winningNumbersString = trim(substr($line, strpos($line, ':') + 2, strpos($line, '|') - strlen($line)));
  $winningNumbers = array_map('intval', array_filter(explode(' ', $winningNumbersString)));

  $myNumbersString = trim(substr($line, strpos($line, '|') + 2, strlen($line)));
  $myNumbers = array_map('intval', array_filter(explode(' ', $myNumbersString)));

  return [$cardId, $winningNumbers, $myNumbers];
}