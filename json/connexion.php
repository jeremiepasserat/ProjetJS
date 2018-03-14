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
$result->connecte = 'pas ok';

$result->test = false;

if (isset ($_POST['id']) && isset($_POST['mdp'])) {
    $_SESSION['connecte'] = "ok";
    $_SESSION['user'] = $_POST['id'];
    $result->connecte = 'ok';
    $result->message = true;
}
else {
    $result->message = "non" ;
    $result->resultat = false;
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($result);