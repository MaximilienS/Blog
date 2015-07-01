<?php

session_start();

define("ROOT", str_replace("index.php", "", $_SERVER["SCRIPT_NAME"]));
// echo ROOT;
define("ROOT_CSS", ROOT."vues/css/");
define("ROOT_JS", ROOT."vues/js/");


$dataSource="mysql:host=localhost; dbname=blog; charset=utf8";
$login="root";
$mdp="troiswa";
$connexion= new PDO ($dataSource, $login, $mdp);
$connexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


			