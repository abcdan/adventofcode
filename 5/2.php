<?php

$contents = file_get_contents(filename: '1.txt');

$rules = [];
$pages = [];

[$rawRules, $rawPages] = explode("\n\n", $contents, 2);

foreach (explode(separator: "\n", string: $rawRules) as $line) {
    $rules[] = explode("|", $line, 2);
}
foreach (explode(separator: "\n", string: $rawPages) as $line) {
    $pages[] = explode(",", $line);
}

function returnInvalidPages($array, $rules)
{
    $validPages = [];
    $inValidPages = [];
    foreach ($array as $page) {
        $isValid = true;

        $pageIndexMap = array_flip($page);

        foreach ($rules as $rule) {
            $first = $rule[0];
            $second = $rule[1];

            if (isset($pageIndexMap[$first]) && isset($pageIndexMap[$second])) {
                $firstIndex = $pageIndexMap[$first];
                $secondIndex = $pageIndexMap[$second];

                if ($firstIndex >= $secondIndex) {
                    $isValid = false;
                    break;
                }
            }
        }

        if ($isValid) {
            $validPages[] = $page;
        } else {
            $inValidPages[] = $page;
        }
    }
    return [$validPages, $inValidPages];
}

[$valid, $invalid] = returnInvalidPages($pages, $rules);

$becameValid = [];

foreach ($invalid as $page) {
    usort($page, function ($a, $b) use ($rules) {
        foreach ($rules as $rule) {
            if ($rule[0] == $a && $rule[1] == $b) {
                return -1;
            }
            if ($rule[0] == $b && $rule[1] == $a) {
                return 1;
            }
        }
        return 0;
    });
    $becameValid[] = $page;
}

echo "Became Valid Pages:\n";
foreach ($becameValid as $page) {
    echo implode(", ", $page) . "\n";
}

$middleNumbers = [];
foreach ($becameValid as $page) {
    if (count($page) % 2 !== 0) {
        $middleIndex = floor(count($page) / 2);
        $middleNumbers[] = $page[$middleIndex];
    }
}

$sum = array_sum($middleNumbers);
echo "Sum of middle numbers: " . $sum . "\n";
