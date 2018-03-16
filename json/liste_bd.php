<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 16/03/18
 * Time: 19:27
 */
/*
 * Permet de charger les titres et la liste des séries à la connexion
 */

session_start();

$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$dsn = 'mysql:host=mysql-tvshowtime-jp.alwaysdata.net;dbname=tvshowtime-jp_bd;charset=utf8';

$pdo = new PDO($dsn, "155055", "155055");
//$pdo->exec('SET CHARACTER SET utf8');
$statement = $pdo->prepare("SELECT * FROM Serie");
$statement->execute();
$result->resultat = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
//$result = html_entity_decode($result);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode(($result->resultat));