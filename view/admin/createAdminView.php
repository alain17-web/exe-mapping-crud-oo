<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administration: création d'un article</title>
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

                <h1>Administration: création d'un article</h1>
                <hr>
                <h3>Exercice, c'est ici que vous allez créer le formulaire d'insertion d'articles</h3>
                <p>Il faut remplacer le formulaire par celui permettant d'ajouter un article</p>
                <p>Tous les champs de la table 'thenews' doivent être présent dans les "name" de ceux-ci, mise à part "idtheNews" et "theNewsDate" (générés automatiquement en SQL) </p>
                <p>Il faut un champs caché "theUser_idtheUser" contenant l'id de l'utilisateur connecté (on la récupère par la session)</p>
                <p>Un utilisateur ne peut poster qu'à son nom!</p>
                <p>Pour valider l'insertion et l'effectuer, vous devrez avoir au préalable rempli les modèles <strong>Thenews</strong> (pour l'hydratation et les vérifications avec les setters) et <strong>ThenewsManager</strong> (pour l'insertion grâce à une méthode dédiée)</p>
                <p>La partie <i>// create article</i> de l'<strong>adminController</strong> devra également être modifié</p>
                <?php
                if(isset($message)):
                ?>
                    <button type="button" class="btn btn-warning"><?=$message?></button>
                <?php
                endif;
                ?>
                <hr>
                <form action="" name="connection" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Votre login :</label>
                        <input name="theUserLogin" type="text" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Entrez votre login" required>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mot de passe</label>
                        <input name="theUserPwd" type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Entrez votre mot de passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
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