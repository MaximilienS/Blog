<?php

if (empty($_GET["id"]==true))
{
	header("location:index.php");
	die();
}

$dataSource="mysql:host=localhost; dbname=blog; charset=utf8";
			$login="root";
			$mdp="troiswa";
			$connexion= new PDO ($dataSource, $login, $mdp);
			$connexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$connexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

require_once __DIR__."/../mode/article.php";

$idarticle = $_GET["id"];
$sql= "SELECT * FROM article WHERE id=$idarticle";
$requete=$connexion->prepare($sql);
$requete->execute();
$result=$requete->fetchAll(PDO::FETCH_CLASS, "article");
$resultatBlog=array_shift($result);


if (empty($resultatBlog)==true){
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	include"vues/404.phtml";
	die();
};


$errors=[];

if (empty($_POST)== false){

	if (empty($_POST["auteur"])) 
		{
			array_push($errors, "Veuillez entrer votre nom");
		}
	
	if (empty($_POST["contenu"])) 
		{
			array_push($errors, "Veuillez entrer un commentaire");
		}
	
	 
	 if (intval($_POST ["note"]) > 5 || intval($_POST ["note"]) <=0){
			array_push($errors, "Veuillez entrer une valeur inférieur ou égal à 5");	
		}


	if (empty($errors)) 
		{
																
			$dataSource="mysql:host=localhost; dbname=blog; charset=utf8";
			$login="root";
			$mdp="troiswa";
			$connexion= new PDO ($dataSource, $login, $mdp);
			$connexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//pour afficher les erreurs
			$sql="INSERT INTO commentaire (auteur, note, contenu, date_commentaire,id_article)
				VALUES(:valueauteur, :valuenote, :valuecontenu, NOW(), $idarticle)";
			$requete= $connexion->prepare($sql);
			//pour sécuriser sa base de données des utilisateurs
			$requete->bindvalue(":valueauteur", $_POST["auteur"]);
			$requete->bindvalue(":valuenote", $_POST["note"]);
			$requete->bindvalue(":valuecontenu", $_POST["contenu"]);	
			$success=$requete->execute();
		}
			
};

require_once __DIR__."/../mode/commentaire.php";

$sql="SELECT* FROM commentaire WHERE id_article=:id";
$requete=$connexion->prepare($sql);
$requete->bindvalue(":id", $idarticle);
$requete->execute();
$resultatCommentaire=$requete->fetchAll(PDO::FETCH_CLASS, "commentaire");