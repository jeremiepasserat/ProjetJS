<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 16/03/18
 * Time: 21:02
 */
/*
*   Permet l'ajout d'un nouveau commentaire pour la série (+ son auteur).
*/


session_start();

$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$result->id =$_POST['id_show_com'];

$date = date("d-m-Y");
$heure = date("H:i");

$com = $_SESSION['user'] . ", le " . $date . " à " . $heure . " : " . $_POST['nvocommentaire'] . "   " . PHP_EOL;


if (($_POST['nvocommentaire']) == ""){
    $result -> post_vide = true;
    $result -> message = "Merci de ne pas laisser le champ vide.";
}
else {

    $dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

    $pdo = new PDO($dsn, "155055", "155055");

    $statement = $pdo->prepare("INSERT INTO Commentaires (Id, Commentaire, Identifiant) VALUES (?, ?, ?)");


    $resultat = $statement->execute(array(($_POST['id_show_com'] + 1), htmlspecialchars($com), $_SESSION['user']));


    if (!$resultat)
    {
        $result->message = "Le petit fail des familles";
    }
    else {
        $result->message = "Merci pour votre commentaire";
    }
}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));