<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>

<form action="index.php?action=modifyMovie&id=<?= $id ?>" method="post">

    <label>Title:</label>
    <input type="text" name="first_name" value="">


    <label>Release date:</label>
    <input type="date" step="any" name="last_name">


    <label>Duration:</label>
    <input type="number" step="any" name="gender">


    <label>Synopsys:</label>
    <input type="text" step="any" name="date_of_birth">

    <label>Notation:</label>
    <input type="number" step="any" name="last_name">


    <label>Poster:</label>
    <input type="text" step="any" name="gender">


    <label>Genre:</label>
    <input type="text" step="any" name="date_of_birth">


    <button type="submit" name="modifyMovie">Save</button>

</form>


<?php
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
