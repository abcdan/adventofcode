<?php

$contents = file_get_contents(filename: '1.txt');

$regex = '/mul\(+[0-9]{1,3},+[0-9]{1,3}\)/';

preg_match_all($regex, $contents, $matches);

$total = 0;

foreach ($matches[0] as $match) {
    $match            = str_replace('mul(', '', $match);
    $match            = str_replace(')', '', $match);
    [$first, $second] = explode(',', $match);

    $multiplied = mul($first, $second);

    $total = $total + $multiplied;
}

echo $total;

function mul($a, $b)
{
    return $a * $b;
}
