<?php

$contents = file_get_contents(filename: '1.txt');
$count    = 0;

foreach (explode(separator: "\n", string: $contents) as $line) {
    $numbers = explode(separator: ' ', string: $line);
    $numbers = array_map(callback: function ($num): int {
        return intval(value: $num);
    }, array:$numbers);

    $safe  = true;
    $index = 0;

    $consecutive = areElementsConsecutive($numbers);

    if ($consecutive) {
        $count++;
    }
}

echo ' ' . $count . '
';

function areElementsConsecutive($array)
{
    for ($i = 0; $i < count($array) - 1; $i++) {
        if ($array[$i] == $array[$i + 1]) {
            return false;
        }
    }

    $a = $array;
    $b = $array;

    sort($a);
    rsort($b);

    if ($array != $a && $array != $b) {
        return false;
    }

    $isPositive = ($array[0] - $array[1]) < 0;
    if ($isPositive) {
        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] - $array[$i - 1] > 3) {
                return false;
            }
        }
    } else {
        for ($i = 1; $i < count($array); $i++) {
            if ($array[$i] - $array[$i - 1] < -3 || $array[$i] - $array[$i - 1] > 0) {
                return false;
            }
        }
    }

    return true;
}
