<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tous les articles de <?= (isset($message))?$message:$user->getTheUserLogin() ;?></title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body id="page-top">
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="?connect">Connexion</a>
                </li>
            </ul>

        </div>
    </div>
</div>

<div class="container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 mx-auto">

                    <h1>Tous les articles de <?= (isset($message))?$message:$user->getTheUserLogin() ;?></h1>
                
                <?php
                if(isset($message)):
                    ?>
                    <button type="button" class="btn btn-warning"><?=$message?></button>
                <?php
                elseif(isset($message2)):
                ?>
                    <button type="button" class="btn btn-warning"><?=$message2?></button>
                <?php
                else:
                    foreach($allNews as $item):
                ?>
                <hr>
                <h4><?=$item->getTheNewsTitle()?></h4>
                <p><?=ThenewsManager::cutTheText($item->getTheNewsText(),150)?>... <a href="?idTheNews=<?=$item->getIdTheNews()?>">Lire la suite</a></p>
                <h5>Le <?=$item->getTheNewsDate()?></h5>
                <hr>
                
                <?php
                    endforeach;
                endif;
                ?>
                <hr>
                <a href="#page-top">Retour en haut</a>
                <hr>
            </div>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
