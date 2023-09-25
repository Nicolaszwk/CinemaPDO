<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<form action="index.php?action=addActor" method="POST">

        <label>First name:</label>
            <input type="text" name="first_name">
        
        
        <label>Last name:</label>
            <input type="text" step="any" name="last_name">
        
        
        <label>Gender:</label>
            <input type="text" step="any" name="gender">
            
       
            <label>Date of birth:</label>
                <input type="date" step="any" name="date_of_birth">
            
        
            <input type="submit" name="addActor" value="Submit">
</form>
        
<?php 
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";