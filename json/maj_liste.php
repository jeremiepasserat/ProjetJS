<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 12/03/18
 * Time: 18:36
 */
include 'series.php';

session_start();



$result = new stdClass();
$result->resultat = true;
//$result->message = " ";
$result->message = $_POST['id'];

$result->commentaire = $_SESSION['serie_' . ($_POST['id']+1)]->getCommentaires();
$result->note = $_SESSION['serie_' . ($_POST['id']+1)]->getNote();


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($result);