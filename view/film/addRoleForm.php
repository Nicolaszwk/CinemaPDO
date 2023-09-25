<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<form action="index.php?action=addRole" method="POST">
    <label for="name">Role:</label>
    <input type="text" id="name" name="name">
    <input type="submit" name="addRole" value="Submit">
</form>

        
<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";