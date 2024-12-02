<?php

$contents = file_get_contents('1.txt');
$count = 0;

foreach (explode("\n", $contents) as $line) {
    $numbers = array_map('intval', explode(' ', $line));

    if (areElementsConsecutive($numbers)) {
        $count++;
    } else {
        for ($i = 0; $i < count($numbers); $i++) {
            $tempNumbers = $numbers;
            array_splice($tempNumbers, $i, 1);
            if (areElementsConsecutive($tempNumbers)) {
                $count++;
                break;
            }
        }
    }
}

echo ' ' . $count . "\n";

function areElementsConsecutive($array) {
    if (count($array) < 2) return true;

    $increasing = true;
    $decreasing = true;

    for ($i = 1; $i < count($array); $i++) {
        $diff = $array[$i] - $array[$i - 1];
        if ($diff > 3 || $diff < -3 || $diff == 0) {
            return false;
        }
        if ($diff < 0) {
            $increasing = false;
        }
        if ($diff > 0) {
            $decreasing = false;
        }
    }

    return $increasing || $decreasing;
}