<?php

function my_str_search(string $haystack, string $needle) {
    // Initialisation du compteur d'occurrences à 0
    $occurrences = 0;

    // Parcours de chaque caractère de la chaîne de caractères $haystack
    for ($i = 0; $i < strlen($haystack); $i++) {
        // Comparaison du caractère courant avec la lettre recherchée $needle
        if ($haystack[$i] === $needle) {
            // Si les caractères correspondent, on incrémente le compteur d'occurrences
            $occurrences++;
        }
    }

    // Affichage du nombre total d'occurrences trouvées
    echo $occurrences;
}

// Exemple d'utilisation de la fonction
my_str_search('Bonjour', 'o'); // Affiche 2


?>