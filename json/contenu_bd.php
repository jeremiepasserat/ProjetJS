<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 16/03/18
 * Time: 21:04
 */

/*
 * Permet d'afficher le contenu des séries (sans la liste initiale).
 * Est utilisé après le click sur une image ou après l'envoi d'une nvelle note/série
 * Si une note est présente dans la BD pour un utilisateur donné le champ de notation est caché.
* La moyenne des notes de la série est calc ulée pour affichage
 */


session_start();

$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$result -> deja_note = false;

$dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

$pdo = new PDO($dsn, "155055", "155055");
//$pdo->exec('SET CHARACTER SET utf8');


// On teste si l'utilisateur à déja noté cette série
$statement = $pdo->prepare("SELECT Identifiant FROM Notes WHERE Id=?");
$statement->execute(array($result->resultat));

$deja_note = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

if (!$deja_note)
{
    $result ->deja_note = true;
}


else {
    // Récupérer la moyenne
    $statement = $pdo->prepare("SELECT AVG(Note) FROM Notes WHERE Id=?");
    $statement->execute(array($result->resultat));

// Moyenne de la série.
    $notes1 = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
}

//Récupérer les com
    $statement = $pdo->prepare("SELECT Commentaire, Identifiant FROM Commentaires WHERE Id=?");
    $statement->execute(array($result->resultat));

// Coms de la série.
    $coms1 = $statement->fetchAll(PDO::FETCH_COLUMN, 1);
// Id de l'utilisateur qui l'a commenté.
    $coms2 = $statement->fetchAll(PDO::FETCH_COLUMN, 2);


// stocker ces infos dans une array par exemple
    $result -> note;
    $result -> commentaires;

//$result = html_entity_decode($result);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result->resultat));