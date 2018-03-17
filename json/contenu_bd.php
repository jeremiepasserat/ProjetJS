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

$statement = $pdo->prepare("SELECT Synopsis FROM Serie WHERE Id=?");
$statement->execute(array(($_POST['id']+1)));
//$statement->execute();

$synopsis = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

$result -> synopsis = $synopsis;



// On teste si l'utilisateur à déja noté cette série
$statement = $pdo->prepare("SELECT Identifiant FROM Notes WHERE Id=?");
$statement->execute(array(($_POST['id']+1)));

$deja_note = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

if (count($deja_note) != 0)
{
    $result -> deja_note = true;
}


else {
    // Récupérer la moyenne
    $statement = $pdo->prepare("SELECT AVG(Note) FROM Notes WHERE Id=?");
    $statement->execute(array(($_POST['id']+1)));

// Moyenne de la série.
    $notes1 = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
    $result -> note = $notes1;
}


//Récupérer les com
    $statement = $pdo->prepare("SELECT Commentaire, Identifiant FROM Commentaires WHERE Id=?");
    $statement->execute(array(($_POST['id']+1)));

// Coms de la série.
    $coms1 = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
// Id de l'utilisateur qui l'a commenté.

    $statement->execute(array(($_POST['id']+1)));
    $coms2 = $statement->fetchAll(PDO::FETCH_COLUMN, 1);


// stocker ces infos dans une array par exemple
    $result -> commentaires = $coms1;
    $result -> pseudos = $coms2;



//$result = html_entity_decode($result);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));