<?php


function my_is_multiple(int $divider, int $multiple): bool {
    
    return $multiple % $divider === 0;
}

$isMultiple = my_is_multiple(2, 4);
$divider = 2;
$multiple = 4; 

if ($isMultiple) {
    echo $multiple . " est un multiple de " . $divider;
} else {
    echo $divider . " n'est pas un multiple de " . $multiple;
}


?>