<?php
/*
 * Admin's controller
 */
require_once "../model/thenews/Thenews.php";
require_once "../model/thenews/ThenewsManager.php";

// Disconnect
if(isset($_GET['disconnect'])){
    if(TheuserManager::disconnectUser()){
        header("Location: ./");
        exit();
    }
}

// create article
if(isset($_GET['create'])){

    // exercice's action
    if(isset($_POST['theNewsTitle'],$_POST['theNewsText'],$_POST['theUser_idtheUser'])){

    }
    if(!empty($_POST)){
        $InsertNews = new Thenews($_POST);
        $insert = $ThenewsManager->insertNews($InsertNews);
        ;
        if($insert === true){
            header("Location: ./");
        }
    }
    // form view
    require_once "../view/admin/createAdminView.php";
    exit();
}

// detail admin article
if(isset($_GET['idarticle'])&&ctype_digit($_GET['idarticle'])){

    // exercice's action

    // form view
    require_once "../view/admin/articleAdminView.php";
    exit();
}

// homepage admin view
require_once "../view/admin/indexAdminView.php";