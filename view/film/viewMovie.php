<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<!-- view/film/viewMovie.php -->

<?php
while ($detail = $film->fetch()) {
    
    // Utilisez les clés du tableau pour accéder aux informations du film
    $filmId = $detail['id_movie'];
    $title = $detail['title'];
    $year = $detail['year'];
    $duration = $detail['duration'];
    $synopsys = $detail['synopsys'];
    $notation = $detail['notation'];
    $poster = $detail['poster'];

    // Afficher les informations du film
    echo "<h1>$title ($year)</h1>";
    echo "<p>Durée : $duration minutes</p>";
    echo "<p>Synopsis : $synopsys</p>";
    echo "<p>Notation : $notation</p>";
    //echo "<img src='$poster' alt='$title' width='200'>";

while ($director = $directors->fetch()) {
    $firstname = $director['firstname'];
    $lastname = $director['lastname'];

    echo "<p>Director: <a href='index.php?action=viewDirector&id=" . $director['director_id'] . "'>$firstname $lastname</a></p>";
}
    
while ($casting = $castings->fetch()) {

    $firstname = $casting['firstname'];;
    $lastname = $casting['lastname'];
    $name = $casting['name'];


    echo "<h2>Cast:</h2>";
    echo "<p><a href='index.php?action=viewActor&id=" . $casting['actor_id'] . "'>$firstname $lastname</a> dans le rôle de $name</p>";
    }
    

    // Vous pouvez également ajouter des liens ou des boutons pour d'autres actions liées au film
    // Par exemple, un lien pour revenir à la liste des films
    echo "<a href='index.php?action=listFilms'>Retour à la liste des films</a>";
} 
?>


<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";