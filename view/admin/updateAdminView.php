<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: modification d'un article</title>
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/custom.min.css" media="screen">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body id="page-top">
<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="./" class="navbar-brand">Accueil de l'administration</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled text-white">Vous êtes connecté avec le login <?=$_SESSION['theUserLogin']?></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="?disconnect">Déconnexion</a>
                </li>
            </ul>

        </div>
    </div>
</div>

<div class="container">

    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 mx-auto">

                <h1>Modification de l'article : <?=$news->getTheNewsTitle()?></h1>
                <hr>
                
                
                <?php
                if(isset($message)):
                ?>
                    <button type="button" class="btn btn-warning"><?=$message?></button>
                <?php
                endif;
                ?>
                <form action="" name="update" method="post">
                    <div class="form-group">
                        <label for="theNewsTitle">Le titre :</label>
                        <input type="text" name="theNewsTitle"  id="theNewsTitle" class="form-control" aria-describedby="theNewsTitle" placeholder="Votre titre" required value="<?php echo htmlspecialchars($news->getTheNewsTitle(),ENT_QUOTES);?>">
                    </div>
                    <div class="form-group">
                        <label for="theNewsText">Le texte :</label>
                        <textarea name="theNewsText" class="form-control" placeholder="Votre texte" aria-describedby="theNewsText" required><?=$news->getTheNewsText()?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="theNewsDate">Date de parution :</label>
                        <input type="text" name="TheNewsDate" class="form-control" placeholder="Date de parution" aria-describedby="TheNewsDate" value="<?=$news->getTheNewsDate()?>" required>
                    </div>
                    <input type="hidden" name="idTheNews" value="<?=$news->getIdTheNews()?>">

                    <button type="submit" class="btn btn-primary">Envoyer"</button>
                    
                </form>
                
                <hr>
                
                
            </div>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>