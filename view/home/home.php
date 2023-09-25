<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<?php
echo '<div id="title_1"><h2>Best movies</h2></div>';
?>

<!-- Additional required wrapper -->
<div class="slick-slider">
<?php



while ($detail = $bestMovie->fetch()) {
    // Utilize the keys of the array to access movie information
    
    // Display the movie poster and link
    echo '<div class="carousel_1"><a href="index.php?action=viewMovie&id=' . $detail['id_movie'] .'">
    <img src="' . $detail['poster'] . '" alt="picture of film : ' . $detail['title'] . '"></a></div>';
}

?>
</div>

<?php
echo '<div id="title_2"><h2>Most recent movies</h2></div>';
?>

<div class="slick-slider">
<?php



while ($detail = $most_recent->fetch()) {
    // Utilize the keys of the array to access movie information
    
    // Display the movie poster and link
    echo '<div class="carousel_2"><a href="index.php?action=viewMovie&id=' . $detail['id_movie'] .'">
    <img src="' . $detail['poster'] . '" alt="picture of film : ' . $detail['title'] . '"></a></div>';
}

?>
</div>

<?php
$title = "Home Page";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
?>
