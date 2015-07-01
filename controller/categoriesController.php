<?php

require_once __DIR__."/../mode/categories.php";


$sql= "SELECT * FROM categories";
$requete=$connexion->prepare($sql);
$requete->execute();
$resultatCategories=$requete->fetchAll(PDO::FETCH_CLASS, "Categories");





if (empty($resultatCategories)==true){
  header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  include"vues/404.phtml";
  die();
};