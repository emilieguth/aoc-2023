<?php
function extractHandAndBid(string $line): array {
  [$hand, $bid] = explode(' ', $line);
  return [$hand, (int)$bid];
}

$order = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];

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
      //echo "4\n";
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

  return compareCards($hand1, $hand2);
}

function compareCards(string $hand1, $hand2): int {
  $order = ['A', 'K', 'Q', 'J', 'T', '9', '8', '7', '6', '5', '4', '3', '2'];

  for ($i = 0; $i < strlen($hand1); $i++) {
    if ($hand1[$i] === $hand2[$i]) {
      continue;
    }
    // la valeur de la carte de la main 1 est plus grande que la valeur de la carte de la main 2 (= l'indice du tableau est plus petit)
    if (array_search($hand1[$i], $order) > array_search($hand2[$i], $order)) {
      return -1;
    }
    if (array_search($hand1[$i], $order) < array_search($hand2[$i], $order)) {
      return 1;
    }
  }

  return 0;
}