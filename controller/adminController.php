<?php
/*
 * Admin's controller
 */

// Disconnect
if(isset($_GET['disconnect'])){
    if(TheuserManager::disconnectUser()){
        header("Location: ./");
        exit();
    }
}

// create article
if(isset($_GET['create'])){
    if(!empty($_POST)){
        $CreateNews = new Thenews($_POST);
        $insert = $newsManager->createNews($CreateNews);
        var_dump($newsManager);
        if($insert===true){
            header("Location:./");
        }
    }
    // exercice's action

    // form view
    require_once "../view/admin/createAdminView.php";
    exit();
}

// delete article
if(isset($_GET['delete'])){
    $idTheNews = (int) $_GET['delete'];

    if(isset($_GET['ok'])){
        $delete = $newsManager->deleteNewsById($idTheNews);

        if($delete===true){
            header("Location:./");
            exit();
        }
        echo $delete;
    }
    else{
        $recup = $newsManager->readOneNewsById($idTheNews);
        if(empty($recup)){
            header("Location:./");
            exit();
        }
        $news = new Thenews($recup);

        require_once "../view/admin/deleteAdminView.php";
    }

}

// update article
if(isset($_GET['update'])){
    
    $idTheNews = (int) $_GET['update'];

    if(!empty($_POST)){
    $updateTheNews = new Thenews($_POST);

    $update = $newsManager->updateNewsById($updateTheNews,$idTheNews);

        if($update===true){
        header("Location:./");
        exit();
        }
        else{
        $error = $update;
        }
    }
    else{
        $recup = $newsManager->readOneNewsById($idTheNews);

        if(empty($recup)){
        exit("Erreur, cet article n'extiste pas encore");
        }
        $news = new TheNews($recup);
    }

    require_once "../view/admin/updateAdminView.php";
    exit();
}



//read all news
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

// homepage admin view
require_once "../view/admin/indexAdminView.php";