<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 10/03/18
 * Time: 19:57
 */
include 'series.php';

session_start();



$result = new stdClass();
$result->resultat = true;
$result->message = " ";


if (isset($_SESSION['serie_1'])){
    $serie1 = $_SESSION['serie_1'];
}
else
    $serie1 = $_SESSION['serie1'];

if (isset($_SESSION['serie_2'])){
    $serie2 = $_SESSION['serie_2'];
}
else
    $serie2 = $_SESSION['serie2'];

if (isset($_SESSION['serie_3'])){
    $serie3 = $_SESSION['serie_3'];
}
else
    $serie3 = $_SESSION['serie3'];

/*
$result->noms = array($_SESSION['serie1']->getNom(), $_SESSION['serie2']->getNom(), $_SESSION['serie3']->getNom());
$result->images = array($_SESSION['serie1']->getImage(), $_SESSION['serie2']->getImage(), $_SESSION['serie3']->getImage());
$result->synopsis = array($_SESSION['serie1']->getSynopsis(), $_SESSION['serie2']->getSynopsis(), $_SESSION['serie3']->getSynopsis());
$result->commentaires = array($_SESSION['serie1']->getCommentaires(), $_SESSION['serie2']->getCommentaires(), $_SESSION['serie3']->getCommentaires());
$result->note = array($_SESSION['serie1']->getNote(), $_SESSION['serie2']->getNote(), $_SESSION['serie3']->getNote());
*/

$result->noms = array($serie1->getNom(), $serie2->getNom(), $serie3->getNom());
$result->images = array($serie1->getImage(), $serie2->getImage(), $serie3->getImage());
$result->synopsis = array($serie1->getSynopsis(), $serie2->getSynopsis(), $serie3->getSynopsis());
$result->commentaires = array($serie1->getCommentaires(), $serie2->getCommentaires(), $serie3->getCommentaires());
$result->note = array($serie1->getNote(), $serie2->getNote(), $serie3->getNote());


//$result->test = $_SESSION['serie1']->getNote();

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($result);

