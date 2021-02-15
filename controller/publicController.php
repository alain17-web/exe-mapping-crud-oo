<?php
/*
 * Public's controller
 */

// connect view
if(isset($_GET['connect'])){
    // click to submit
    if(!empty($_POST)){
        // create an instance and hydrate Theuser
        $recupUser = new Theuser($_POST);
        // try to connect
        $connectUser = $userManager->connectUser($recupUser);
        // connect ok (strict true)
        if($connectUser===true){
            header("Location: ./");
            exit();
        }
        // connect not ok without sql error (false)
        if(!$connectUser){
            $message = "Login et/ou mot de passe incorrecte";
        // sql error
        }else{
            $message = $connectUser;
        }
    }
    require_once "../view/public/connectPublicView.php";
    exit();
}

// article detail view
if(isset($_GET['idTheNews'])&&ctype_digit($_GET['idTheNews'])){
    // conversion en entier
    $idTheNews = (int) $_GET['idTheNews'];
    $recupNews = $newsManager->readOneNewsById($idTheNews);

    if(empty($recupNews)){
        $message ="Cet article n'existe plus";
    }else{
        $news = new Thenews($recupNews);
    }
    // view
    require_once "../view/public/newsPublicView.php";
    exit();
}

// author detail view
if(isset($_GET['idauteur'])&&ctype_digit($_GET['idauteur'])){
    // select author
    $iduser = (int) $_GET['idauteur'];
    $recup = $userManager->selectOneUserById($iduser);
    // no sql error
    if(is_array($recup)){
        // user exist
        if(!empty($recup)){
            $user = new Theuser($recup);
        }else{
            $message = "Cet utilisateur n'existe plus";
        }
    }else{
        $message = $recup;
    }

    //voir tous les articles de l'auteur
    $news = $newsManager->readAllNewsByIdUser($iduser);
    if(empty($news)){
        $message2 = "Cet auteur n'a pas écrit d'article";
    }
    else{
        foreach($news AS $item){
            $allNews[] = new Thenews($item);
        }
    }
    

    // view
    require_once "../view/public/auteurPublicView.php";
    exit();
}

// Voir tous les articles

// on récupère toutes les news dans un tableau indexé contenant des tableaux associatifs
    $recupNews = $newsManager->readAllNews();

// si le tableau est vide
    if(empty($recupNews)){
    // création d'un message d'erreur
    $message = "Pas encore d'articles";
    }else{
    // sinon, on va passer chacun des résultats dans la classe de type TheNews
        foreach($recupNews As $item){
        $allNews[]= new Thenews($item);
        }
    }


// home view
require_once "../view/public/indexPublicView.php";