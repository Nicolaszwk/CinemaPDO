<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<form action="index.php?action=addGenre" method="POST">

    <label for="label">Genre:</label>
    <input type="text" id="label" name="label">

    <input type="submit" name="addGenre" value="Submit">

</form>
        
<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";