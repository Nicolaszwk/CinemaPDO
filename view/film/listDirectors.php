<?php
ob_start(); //def : Enclenche la temporisation de sortie
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include Font Awesome stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Other meta tags, title, etc. -->
</head>

<body>
    <div class="uk-section uk-section-secondary">
        <div class="uk-container">
            <h1>Lists of directors <span class="uk-badge"><?= $directors->rowCount() ?></span></h1>

            <div class="uk-grid-match uk-flex-center" uk-grid>
                <?php
                while ($detail = $directors->fetch()) { ?>

                    <div class="uk-width-auto uk-height-match" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 500">
                    
                    <div class="uk-card uk-card-small uk-card-default uk-height-match uk-border-rounded">
    

                                <figure class="uk-height-match uk-border-rounded">
                                    <figcaption class="uk-text-center uk-margin-small-top uk-margin-small-bottom">
                                        <a class="uk-link-toggle" href="index.php?action=viewDirector&id=<?= $detail['id_director']; ?>"><strong><?= $detail['lastname'] ?></strong></a>
                                    </figcaption>
                                </figure>
                                <button><a href="index.php?action=modifyDirectorForm&id=<?= $detail['id_director']; ?>">Edit</a></button>
                                <button><a href="index.php?action=deleteDirector&id=<?= $detail['id_director']; ?>">Delete</a></button>

                            </div>
                    </div>


                <?php }
                ?>
            </div>

        </div>
    </div>
</body>

</html>


<?php
$title = "List of directors";
$content = ob_get_clean(); //def : Exécute successivement ob_get_contents() et ob_end_clean(). Lit le contenu courant du tampon de sortie puis l'efface
require "view/template.php";
