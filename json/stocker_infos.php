<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 12/03/18
 * Time: 15:37
 */


include 'series.php';

session_start();


$result = new stdClass();
$result->resultat = true;
$result->message = " ";

$result->noter = true;

$result->id_note =$_POST['id_show_note'];
$result->id_com =$_POST['id_show_com'];

//$result->set = 'isset';


if (($_POST['nvocommentaire']) == ""){
    $result -> post_vide = true;
    $result -> message = "Merci de ne pas laisser le champ vide.";
}
else {

        if (isset($_SESSION['serie_' . ($_POST['id_show_com'] + 1)])) {
            $show = $_SESSION['serie_' . ($_POST['id_show_com'] + 1)];
        } else {
            $show = $_SESSION['serie' . ($_POST['id_show_com'] + 1)];
        }
        $show->addCommentaires($_SESSION['user'] . ', le '. date("Y-m-d H:i:s") . ' : ' . htmlspecialchars($_POST['nvocommentaire']) . '</br>');
        $_SESSION['serie_' . ($_POST['id_show_com'] + 1)] = $show;


        $result->message = "Merci pour votre commentaire !";
        $result->commentaire = htmlspecialchars($_POST['nvocommentaire']);

    }

// pour protéger la validité des notes mettre un !is_numeric(note).

// dupliquer code d'au dessus
if (isset ($_POST['nvellenote'])) {
        $result->test = 'nvellenote';

}
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

echo json_encode($result);
