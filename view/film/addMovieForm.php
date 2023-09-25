<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<form action="index.php?action=addMovie" method="post">
    <div class="form">
        <label>Title:</label>
        <input type="text" name="title"><br>

        <label>Release date:</label>
        <input type="date" step="any" name="releaseDate"><br>

        <label>Duration (minutes):</label>
        <input type="text" step="any" name="duration"><br>

        <label>Synopsys:</label>
        <input type="text" step="any" name="synopsys"><br>

        <label>Notation:</label>
        <input type="text" step="any" name="notation"><br>

        <label>Poster:</label>
        <input type="text" step="any" name="poster"><br>

        <label>Genre:</label>
        <select name="genre" id="genre">
            <?php
            // Loop through the director list and create option elements
            while ($detail = $genrelist->fetch()) {
                echo '<option value="' . $detail['id_genre'] . '">' . $detail['label'] . '</option>';
            }
            ?>
        </select>

        <label>Director:</label>
        <select name="director" id="director">
            <?php
            // Loop through the director list and create option elements
            while ($detail = $directorlist->fetch()) {
                echo '<option value="' . $detail['id_director'] . '">' . $detail['firstname'] . ' ' . $detail['lastname'] . '</option>';
            }
            ?>
        </select>

        <input type="submit" name="addMovie" value="Submit"><br>

    </div>

    <?php
    $content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
    require "view/template.php";
