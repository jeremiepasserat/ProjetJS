<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 16/03/18
 * Time: 19:27
 */
/*
 * Permet de charger les titres, les images et les synopsis (cachés dans un 1er temps) des séries à la connexion
 */

session_start();

$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$result->titres;
$result->images;

$dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

$pdo = new PDO($dsn, "155055", "155055");
$statement = $pdo->prepare("SELECT Titre, Image FROM Serie");
$statement->execute();

$titres = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

$statement = $pdo->prepare("SELECT Titre, Image FROM Serie");
$statement->execute();

$images = $statement->fetchAll(PDO::FETCH_COLUMN, 1);

$result->titres = $titres;
$result->images = $images;


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result));