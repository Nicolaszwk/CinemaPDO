<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<form action="index.php?action=addDirector" method="POST">
<p>
        <label>
                First name:
                <input type="text" name="first_name">
            </label>
        </p>
        <p>
            <label>
                Last name:
                <input type="text" step="any" name="last_name">
            </label>
        </p>
        <p>
            <label>
                Gender:
                <input type="text" step="any" name="gender">
            </label>
        </p>
        <p>
            <label>
                Date of birth:
                <input type="date" step="any" name="date_of_birth">
            </label>
        </p>
        <p>
            <input type="submit" name="addDirector" value="Submit">
        </p>
<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";