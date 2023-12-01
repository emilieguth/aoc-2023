<?php
$fp = @fopen("input-exo.txt", "r");
$total = 0;
$dictionary = ['one' => 1, 'two' => 2, "three" => 3, 'four' => 4, 'five' => 5, 'six' =>6, 'seven' => 7, 'eight' => 8, 'nine' => 9];
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $buffer = trim($buffer);
        $first = null;
        $firstIndex = null;
        $last = null;
        $lastIndex = null;
        for($i = 0; $i < strlen($buffer); $i++) {
            if (is_numeric($buffer[$i])) {
                if($first === null){
                    $first = (int)$buffer[$i];
                    $firstIndex = $i;
                } else {
                    $last = (int)$buffer[$i];
                    $lastIndex = $i;
                }
            }
        }
        foreach ($dictionary as $number => $value) {
            $positionFirst = strpos($buffer, $number);
            if ($positionFirst !== false) {
                if ($positionFirst < $firstIndex || $firstIndex === null) {
                    if ($last === null) {
                        $last = $first;
                        $lastIndex = $firstIndex;
                    }
                    $first = $value;
                    $firstIndex = $positionFirst;
                } else if ($positionFirst > $lastIndex || $lastIndex === null) {
                    $last = $value;
                    $lastIndex = $positionFirst;
                }
            }
            $positionLast = strrpos($buffer, $number);
            if ($positionLast !== false) {
                if ($positionLast < $firstIndex || $firstIndex === null) {
                    if ($last === null) {
                        $last = $first;
                        $lastIndex = $firstIndex;
                    }
                    $first = $value;
                    $firstIndex = $positionLast;
                } else if ($positionLast > $lastIndex || $lastIndex === null) {
                    $last = $value;
                    $lastIndex = $positionLast;
                }
            }
        }
        if ($last === null) {
            $last = $first;
        }

        $value = (int)($first.$last);
        var_dump($buffer, $value);
        $total += $value;
    }
    if (!feof($fp)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
}

var_dump($total);
?>
