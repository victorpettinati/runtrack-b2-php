<?php

function my_array_sort(array $arrayToSort, string $order): array {
    if ($order === "ASC") {
        sort($arrayToSort);
    } elseif ($order === "DESC") {
        rsort($arrayToSort);
    }

    return $arrayToSort;
}

// Exemple d'utilisation de la fonction
$array1 = [5, 3, 9, 1, 7];
$sortedArray1Asc = my_array_sort($array1, "ASC");
$sortedArray1Desc = my_array_sort($array1, "DESC");
echo implode(', ', $sortedArray1Asc) . "\n"; // Tri croissant des nombres
echo implode(', ', $sortedArray1Desc) . "\n"; // Tri décroissant des nombres

$array2 = ["banana", "apple", "cherry", "date"];
$sortedArray2Asc = my_array_sort($array2, "ASC");
$sortedArray2Desc = my_array_sort($array2, "DESC");
echo implode(', ', $sortedArray2Asc) . "\n"; // Tri alphabétique croissant des chaînes de caractères
echo implode(', ', $sortedArray2Desc) . "\n"; // Tri alphabétique décroissant des chaînes de caractères

?>