<?php

function my_fizz_buzz(int $length): string {
    $result = array();

    for ($i = 1; $i <= $length; $i++) {
        $value = "";
        if ($i % 3 === 0) {
            $value .= "Fizz";
        }
        if ($i % 5 === 0) {
            $value .= "Buzz";
        }
        if ($value === "") {
            $value = $i;
        }
        $result[] = $value;
    }
    return implode(', ', $result);
}

$fizzBuzzString = my_fizz_buzz(15);
echo $fizzBuzzString;




?>