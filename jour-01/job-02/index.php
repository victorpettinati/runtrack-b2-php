<?php

function my_str_reverse(string $string): string {

    $reversedString = strrev($string);
    
    return $reversedString;
}

$resultat = my_str_reverse('Bonjour');
echo $resultat; 

?>
