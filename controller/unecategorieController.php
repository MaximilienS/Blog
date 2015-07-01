<?php


require_once __DIR__."/../mode/article.php";

$sql= "SELECT * FROM article WHERE id_categorie= :idcategorie";
$requete=$connexion->prepare($sql);
$requete->bindvalue(":idcategorie", $_GET["id"]);
$requete->execute();
$resultatUnecategorie=$requete->fetchAll(PDO::FETCH_CLASS, "article");


if (empty($resultatUnecategorie)==true){
  header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
  include"vues/404.phtml";
  die();
};