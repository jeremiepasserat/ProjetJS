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

$titre = $_POST['titre'];
$image = $_POST['image'];
$synopsis = $_POST['new_synopsis'];

$result->vide = false;

if (!isset($titre) || !isset($image) || !isset($synopsis))
    $result->message = "Merci de remplir les champs";

$dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

$pdo = new PDO($dsn, "155055", "155055");

$statement = $pdo->prepare("INSERT INTO Series (Titre, Image, Synopsis) VALUES (?, ?, ?)");
$resultat = $statement->execute(array(htmlspecialchars($titre), $image, htmlspecialchars($synopsis)));

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));