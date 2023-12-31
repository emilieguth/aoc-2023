<?php
require __DIR__ . '/utils.php';
require __DIR__ . '/../utils.php';
$lines = extractFileToArray('input.txt');

$results = [];
$allHandsAndBids = [];
$allHands = [];

foreach($lines as $line) {
  [$hand, $bid] = extractHandAndBid($line);
  $allHandsAndBids[$hand] = $bid;
  $allHands[] = $hand;
}

usort($allHands, 'sortHands');
$result = [];
foreach($allHands as $index => $hand) {
  $results[] = $allHandsAndBids[$hand] * ($index + 1);
}

var_dump(array_sum($results));


function sortHands(string $hand1, string $hand2): int {
  $hand1Count = [];
  $hand2Count = [];

  for($i = 0; $i < strlen($hand1); $i++) {

    $hand1Count[$hand1[$i]] ??= 0;
    $hand2Count[$hand2[$i]] ??= 0;

    $hand1Count[$hand1[$i]]++;
    $hand2Count[$hand2[$i]]++;

  }

  if (max($hand1Count) < max($hand2Count)) {
    return -1;
  }

  if (max($hand1Count) > max($hand2Count)) {
    return 1;
  }

  // full house & three of a kind
  if (max($hand1Count) === 3) {
    if (count($hand1Count) > 2 and count($hand2Count) === 2) {
      return -1;
    }
    if (count($hand1Count) === 2 and count($hand2Count) > 2) {
      return 1;
    }
  }

  // 2 pairs
  if (max($hand1Count) === 2) {
    if (count($hand1Count) > 3 and count($hand2Count) === 3) {
      return -1;
    }
    if (count($hand1Count) === 3 and count($hand2Count) > 3) {
      return 1;
    }
  }

  $order = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];
  return compareCards($hand1, $hand2, $order);
}