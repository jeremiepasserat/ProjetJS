<?php
session_start();

$result = new stdClass();
$result->result = true;
$result->message = "";


$result->test = false;

if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == 'ok')
{
    $result->test = true;
}
else {

    $result->result = false;
    $result->message = 'Pas connecté';
}


header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
echo json_encode($result);
