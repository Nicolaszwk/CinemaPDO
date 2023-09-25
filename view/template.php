<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.5.9/css/uikit.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
    
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <link rel="stylesheet" href="public/css/style.css">

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
    
    
    
   


    
    


    <title><?= $title ?></title>
</head>

<body>
    <header>
        <nav class="">
            <div class="">
                <div uk-navbar>

                    <div id="navbar">

                        <ul class="">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                            <li>
                                <a href="index.php?action=listFilms">Films</a>
                            </li>
                            <li>
                                <a href="index.php?action=listDirectors">Directors</a>
                            </li>
                            <li>
                                <a href="index.php?action=listActors">Actors</a>
                            </li>
                            <li>
                                <a href="index.php?action=addDirectorForm">Add director</a>
                            </li>
                            <li>
                                <a href="index.php?action=addActorForm">Add actor</a>
                            </li>
                            <li>
                                <a href="index.php?action=addGenreForm">Add genre</a>
                            </li>
                            <li>
                                <a href="index.php?action=addRoleForm">Add role</a>
                            </li>
                            <li>
                                <a href="index.php?action=addMovieForm">Add movie</a>
                            </li>
                            <li>
                                <a href="index.php?action=addCastingForm">Add Casting</a>
                            </li>
                        </ul>

                    </div>

    </header>
    <main>


        <?= $content ?>
    </main>
    <footer class="">
        <small>2023 &copy; Cinema - Cinema by </small>
    </footer>
    <script src="public/js/script.js"></script>
</body>

</html>