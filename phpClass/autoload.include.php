<?php 
spl_autoload_register(function ($nom_classe /** Nom de la classe dont la définition manque */) {
    // Nom du fichier = nom_de_la_classe.class.php
    $fichier =$nom_classe.'.class.php' ;
    // Existe ?
    if (file_exists($fichier))
        // Oui : l'inclure
        require_once($fichier) ;
    // Pour être compatible avec le système de gestion des corrections
    if (file_exists('../' . $fichier))
        // Oui : l'inclure
        require_once('../' . $fichier) ;

    if (file_exists('class/' . $fichier))
        // Oui : l'inclure
        require_once('class/' . $fichier) ;
}
) ;