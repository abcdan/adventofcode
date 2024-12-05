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

$validPages = [];
foreach ($pages as $page) {
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
    }
}
foreach ($validPages as $page) {
    echo implode(", ", $page) . "\n";
}

foreach ($validPages as $page) {
    if (count($page) % 2 !== 0) {
        $middleIndex = floor(count($page) / 2);
        $middleNumbers[] = $page[$middleIndex];
    }
}

$sum = array_sum($middleNumbers);
echo "Sum of middle numbers: " . $sum . "\n";
