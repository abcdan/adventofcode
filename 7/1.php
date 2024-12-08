<?php

$contents = file_get_contents(filename: '1.txt');

$sums = [];

foreach (explode(separator: "\n", string: $contents) as $line) {
    $parts = explode(separator: ':', string: $line);
    $answer = intval(value: $parts[0]);
    $values = array_map(callback: 'intval', array: explode(separator: ' ', string: trim(string: $parts[1])));
    $sums[] = [$answer, $values];
}

$valid = [];
foreach ($sums as $sum) {
    $answer = $sum[0];
    $values = $sum[1];
    $options = createOptions($values);

    echo "Trying formulas for answer $answer:\n";
    foreach ($options as $option) {
        echo "  $option\n";
    }
    foreach ($options as $option) {
        $result = evaluateLeftToRight($option);
        if ($result === $answer) {
            $valid[] = $answer;
            break;
        }
    }
}

echo array_sum(array: $valid);

function createOptions($values): array
{
    $count = count(value: $values);
    if ($count === 1) {
        return [(string) $values[0]];
    }

    $options = [];
    $firstValue = $values[0];
    $remainingOptions = createOptions(array_slice($values, 1));

    foreach ($remainingOptions as $option) {
        $options[] = $firstValue . '+' . $option;
        $options[] = $firstValue . '*' . $option;
    }

    return $options;
}

function evaluateLeftToRight(string $formula): int
{
    $parts = str_split($formula);
    $result = 0;
    $currentNumber = '';
    $operator = '+';

    foreach ($parts as $char) {
        if ($char === '+' || $char === '*') {
            if ($operator === '+') {
                $result += intval($currentNumber);
            } else {
                $result *= intval($currentNumber);
            }
            $operator = $char;
            $currentNumber = '';
        } else {
            $currentNumber .= $char;
        }
    }

    if ($operator === '+') {
        $result += intval($currentNumber);
    } else {
        $result *= intval($currentNumber);
    }

    return $result;
}
