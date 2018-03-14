<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 25/02/18
 * Time: 17:13
 */
session_start();



if (isset($_SESSION['serie_1'])){
    $serie1 = $_SESSION['serie_1'];
}

if (isset($_SESSION['serie_2'])){
    $serie2 = $_SESSION['serie_2'];
}

if (isset($_SESSION['serie_3'])){
    $serie3 = $_SESSION['serie_3'];
}

// Détruit toutes les variables de session
$_SESSION = array();



// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalement, on détruit la session.
session_destroy();

if (isset($serie1)){
    $_SESSION['serie_1'] = $serie1  ;
}

if (isset($serie2)){
    $_SESSION['serie_2'] = $serie2;
}

if (isset($serie3)){
    $_SESSION['serie_3'] = $serie3;
}