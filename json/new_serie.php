<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 14/03/18
 * Time: 20:01
 */

session_start();

$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$titre = $_POST['new_titre'];
$poster = $_POST['poster'];
$synopsis = $_POST['new_synopsis'];

$result->vide = false;

    if ($titre == "" || $synopsis == "") {
        $result->vide = true;
        $result->message = "Merci de remplir les champs";
    } else {
        $result->message = "Merci pour votre ajout";
        $dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

        $pdo = new PDO($dsn, "155055", "155055");

        $statement = $pdo->prepare("INSERT INTO Serie (Id, Titre, Image, Synopsis) VALUES (?, ?, ?, ?)");

        $resultat = $statement->execute(array(0, htmlspecialchars($titre), htmlspecialchars($poster), htmlspecialchars($synopsis)));


        if (!$resultat)
            $result->message = "L'ajout à échoué";
    }

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));