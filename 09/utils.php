<?php

function formatInput(string $line): array {
  return array_values(array_map('intval', explode(' ', $line)));
}