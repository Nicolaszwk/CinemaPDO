<?php
ob_start(); //def : Enclenche la temporisation de sortie

var_dump($formValues);
?>

<form action="index.php?action=addCasting" method="post">
    <div class="form">
        
        <label>Movie:</label>
        <select name="movie" id="movie">
            <option value="title" <?= $formValues == null || $formValues['movieId'] == null ? "selected" : "" ?> disabled>&lt; select a movie &gt;</option>

            <?php
            // Loop through the movielist and create option elements
            while ($detail = $dropDownMovies->fetch()) {
                $selectedString = $formValues != null && $detail['id_movie'] == $formValues['movieId'] ? ' selected' : '';

                echo '<option' . $selectedString . ' value="' . $detail['id_movie'] . '">' . $detail['title'] . '</option>';
            }
            ?>
        </select>

        <label>Actor:</label>
        <select name="actor" id="actor">
            <option value="title" <?= $formValues == null || $formValues['actorId'] == null ? "selected" : "" ?> disabled>&lt; select an actor &gt;</option>

            <?php
            // Loop through the actor list and create option elements
            while ($detail = $dropDownActors->fetch()) {
                $selectedString = $formValues != null && $detail['id_actor'] == $formValues['actorId'] ? ' selected' : '';

                echo '<option' . $selectedString . ' value="' . $detail['id_actor'] . '">' . $detail['firstname'] . ' ' . $detail['lastname'] . '</option>';
            }
            ?>
        </select>

        <label>Role:</label>
        <select name="role" id="role">
            <option value="title" <?= $formValues == null || $formValues['roleId'] == null ? "selected" : "" ?> disabled>&lt; select a role &gt;</option>

            <?php
            // Loop through the director list and create option elements
            while ($detail = $dropDownRoles->fetch()) {
                $selectedString = $formValues != null && $detail['id_role'] == $formValues['roleId'] ? ' selected' : '';

                echo '<option' . $selectedString . ' value="' . $detail['id_role'] . '">' . $detail['name'] . '</option>';
            }
            ?>
        </select>

        <input type="submit" name="addCasting" value="Submit"><br>

    </div>

    <?php
    $content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
    require "view/template.php";
