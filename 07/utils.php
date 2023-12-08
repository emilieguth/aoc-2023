<?php
function extractHandAndBid(string $line): array {
  [$hand, $bid] = explode(' ', $line);
  return [$hand, (int)$bid];
}

function compareCards(string $hand1, string $hand2, array $order): int {
  for ($i = 0; $i < strlen($hand1); $i++) {
    if ($hand1[$i] === $hand2[$i]) {
      continue;
    }
    if (array_search($hand1[$i], $order) > array_search($hand2[$i], $order)) {
      return -1;
    }
    if (array_search($hand1[$i], $order) < array_search($hand2[$i], $order)) {
      return 1;
    }
  }

  return 0;
}