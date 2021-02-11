<?php
/*
 * Front Controller
 */

// Session
session_start();

/*
 * Dependencies
 */
require_once "../config.php";
require_once "../model/MyPDO.php";
require_once "../model/theuser/Theuser.php";
require_once "../model/theuser/TheuserManager.php";
// Appeler les modèles Thenews et ThenewsManager
require_once "../model/thenews/Thenews.php";
/*
$test = new Thenews(['idtheNews'=>8]);
var_dump($test);
echo $test->getIdtheNews();
*/

require_once "../model/thenews/ThenewsManager.php";

// DB's connection
try{
    $myConnect = new MyPDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=".DB_CHARSET,DB_LOGIN,DB_PWD,ENV_DEV);
}catch(PDOException $e){
    die($e->getMessage());
}

// create TheuserManager
$userManager = new TheuserManager($myConnect);
// create ThenewsManager
$newsManager = new ThenewsManager($myConnect);

// session routing
if(isset($_SESSION['idsession'])&&$_SESSION['idsession']==session_id()){
    // admin
    require_once "../controller/adminController.php";
}else{
    // public
    require_once "../controller/publicController.php";
}