<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<?php

if ($director = $director->fetch()) {

    $firstname = $director['firstname'];
    $lastname = $director['lastname'];
    
    echo "<h1>$firstname $lastname</h1>";
}

    
echo "<p>Movies:</p>";

while ($movie = $movies->fetch()) {

    // Utilisez les clés du tableau pour accéder aux informations du réalisateur
    
    $movieTitle = $movie['title'];


    // Afficher les informations du réalisateur
    
    echo "<a href='index.php?action=viewMovie&id={$movie['id_movie']}'><p>$movieTitle</p></a><br>";
   
    

   
} 
 // Vous pouvez également ajouter des liens ou des boutons pour d'autres actions liées au film
    // Par exemple, un lien pour revenir à la liste des films
    echo "<a href='index.php?action=listFilms'>Retour à la liste des films</a>";
?>


<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
