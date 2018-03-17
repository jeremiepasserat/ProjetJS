<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 25/02/18
 * Time: 17:07
 */
session_start();


$result = new stdClass();
$result->resultat = true;
$result->message = " ";
$result->connecte = false;

$result->test = false;

if (($_POST['id'] == "") || ($_POST['mdp'] == "")){
    $result->message = "merci de ne pas laisser un champ vide";
}
else {
    if (isset ($_POST['id']) && isset($_POST['mdp'])) {
        if (($_POST['id'] == "olivier") && ($_POST['mdp'] == "pons"))  {
            $_SESSION['connecte'] = "ok";
            $_SESSION['user'] = $_POST['id'];
            $result->truc = 'truc';
            $result->connecte = true;
        }

        if (($_POST['id'] == "test") && ($_POST['mdp'] == "test"))  {
            $_SESSION['connecte'] = "ok";
            $_SESSION['user'] = $_POST['id'];
            $result->truc = 'truc';
            $result->connecte = true;
        }
        $result->message = "erreur d'identifiants";


    }
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($result);