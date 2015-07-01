<?php

$dataSource="mysql:host=localhost; dbname=blog; charset=utf8";
			$login="root";
			$mdp="troiswa";
			$connexion= new PDO ($dataSource, $login, $mdp);
			$connexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


require_once __DIR__."/../mode/article.php";

$sql="SELECT* FROM article";
$requete=$connexion->prepare($sql);
$requete->execute();
$resultatBlog=$requete->fetchAll(PDO::FETCH_CLASS, "article");
