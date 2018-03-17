<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 16/03/18
 * Time: 21:02
 */

/*
*   Permet l'ajout d'une nouvelle note pour une série
*/


$dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

$pdo = new PDO($dsn, "155055", "155055");

$statement = $pdo->prepare("INSERT INTO Notes (Id, Note, Identifiant) VALUES (?, ?, ?)");
$resultat = $statement->execute(array(($_POST['id_show_note'] + 1), $com, $_SESSION['user']));

  $statement = $pdo->prepare("SELECT Titre, Image FROM Serie");
  $resultat = $statement->execute();

if (!$resultat)
{
    $result->message = "Le petit fail des familles";
}
else {
    $result->message = "Merci pour votre commentaire";
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));