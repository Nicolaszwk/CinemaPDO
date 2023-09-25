<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<?php

while ($detail = $actor->fetch()){

$firstname = $detail['firstname'];
$lastname = $detail['lastname'];


echo "<h1>$firstname $lastname</h1>";
echo "<p>Movies:</p>";
}


while ($detail = $castings->fetch()) {


    // Utilisez les clés du tableau pour accéder aux informations de l'acteur
   
    $movies_played = $detail['title'];

    // Afficher les informations de l'acteur
    
   
    echo "<a href='index.php?action=viewMovie&id={$detail['movie_id']}'>$movies_played</a><br>";

} 
  // Vous pouvez également ajouter des liens ou des boutons pour d'autres actions liées au film
    // Par exemple, un lien pour revenir à la liste des films
    echo "<br><a href='index.php?action=listFilms'>Retour à la liste des films</a>";
?>


<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
