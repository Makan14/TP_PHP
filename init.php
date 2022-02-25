<?php

//connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=makan', 'root', '', array(
    
    
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', 
) );

// j initialise cs 2 variables a vide(ne rien mettre entre ls quotes mm pas 1 space car je vais en avoir bsoin sur ttes mes pages du sites)
$erreur = '';
$content = '';

?>