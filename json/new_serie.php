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

$image = $_FILES['icone']['name'];
$synopsis = $_POST['new_synopsis'];

$result->vide = false;

$result -> test1 = $titre;
$result -> test2 = $synopsis;
$result -> test3 = $_FILES['icone']['name'];

if ($titre == "" || $synopsis == "")
{
    $result->vide = true;
    $result->message = "Merci de remplir les champs";
}
else {
    $result->message = "Héhéhé ta série est sur mon site";
    $dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

    $pdo = new PDO($dsn, "155055", "155055");

    //$statement = $pdo->prepare("INSERT INTO Series (Titre, Image, Synopsis) VALUES (?, ?, ?)");
    //$resultat = $statement->execute(array(htmlspecialchars($titre), $image, htmlspecialchars($synopsis)));
}

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));