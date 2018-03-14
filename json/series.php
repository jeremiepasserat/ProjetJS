<?php
/**
 * Created by PhpStorm.
 * User: chrx
 * Date: 11/03/18
 * Time: 13:03
 */
include 'Serie.php';
session_start();

    $_SESSION['test'] = 'prout';


    $ac = new Serie();
    $synopsis_ac = "Dans un futur où les humains peuvent transférer leur esprit d'un corps à l'autre,
un rebelle est ramené à la vie 250 ans après sa mort pour résoudre le meurtre vicieux de
l'homme le plus riche du monde, en échange de sa liberté. Pour y parvenir il devra trouver des alliés, 
faire attention à tous les détails et se souvenir de ce qui lui a été appris 
en tant que \"corps diplomatique\"/\"diplo\".";


    $ac->setNom("Altered Carbon")->setSynopsis($synopsis_ac)->setImage("/img/ac.jpeg");



    $f = new Serie();
    $synopsis_f = "En 2006 à Bemidji dans le Minnesota, Lester Nygaard, interprété par Martin Freeman, 
est un homme effacé et sans envergure travaillant pour une compagnie d'assurance. Sa vie bascule le jour où 
il décide de se confier à un homme, Lorne Malvo, interprété par Billy Bob Thornton, qui se révéle être un 
tueur à gages. Celui-ci tue un certain Sam Hess, qui, dans sa jeunesse, harcelait Lester au lycée. Un mensonge
en entraînant un autre, Lester va radicalement changer de vie et extérioriser sa véritable personnalité, 
celle d'un manipulateur prêt à tout pour être accepté par une société qui l'a trop longtemps ignoré.";

    $f->setNom("Fargo")->setSynopsis($synopsis_f)->setImage("/img/f.jpg");

    $st = new Serie();
    $synopsis_st = "Un soir de novembre 1983 à Hawkins, dans l'Indiana, le jeune Will Byers, douze ans, 
disparaît brusquement sans laisser de traces, mis à part son vélo. Plusieurs personnages vont alors tenter de 
le retrouver : sa mère Joyce, ses amis menés par Mike Wheeler et guidés par la mystérieuse Onze, ayant des pouvoirs 
psychiques, ainsi que le chef de la police Jim Hopper. Parallèlement, la ville est le théâtre de phénomènes 
surnaturels liés au Laboratoire national d'Hawkins, géré par le département de l'Énergie (DoE) et indirectement 
la Central Intelligence Agency (CIA) et dont les expériences dans le cadre du projet MKULTRA ne semblent pas 
étrangères à la disparition de Will.";

    $st->setNom("Stanger Things")->setSynopsis($synopsis_st)->setImage("/img/st.jpg");

    $_SESSION['serie1'] = $ac;
    $_SESSION['serie2'] = $f;
    $_SESSION['serie3'] = $st;