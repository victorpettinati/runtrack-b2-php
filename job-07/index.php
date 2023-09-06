<?php

function my_closest_to_zero(array $array): int {
    if (empty($array)) {
        return 0;
    }

    $closest = $array[0];

    foreach ($array as $number) {
        if (abs($number) < abs($closest)) {
            $closest = $number;
        } elseif (abs($number) === abs($closest) && $number > 0) {
            $closest = $number;
        }
    }

    return $closest;
}

$numbers = [5, -3, 33, -8, 7];
$closestToZero = my_closest_to_zero($numbers);
echo "Le nombre le plus proche de zéro est : " . $closestToZero;

?>