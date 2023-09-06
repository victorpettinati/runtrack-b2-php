<?php

function my_is_prime(int $number): bool {
    if ($number <= 1) {
        return false;
    }

    if ($number === 2) {
        return true;
    }

    for ($i = 2; $i <= sqrt($number); $i++) {
        if ($number % $i === 0) {
            return false; 
        }
    }

    return true;
}

$number = 12; 
$isPrime = my_is_prime($number); 

if ($isPrime) {
    echo $number . " est un nombre premier";
} else {
    echo $number . " n'est pas un nombre premier";
}

?>
