<?php




//foreach (unserialize($_COOKIE["favoris"]) as $key => $value){



if (empty($_GET["supprimer"])== false){
	setcookie("favoris", null, -1, "/");
	header("Location:index.php?page=favoris");
	die();
};

$resultatfavoris=[];

if(empty($_COOKIE["favoris"])==false){

	$comma_separated = implode(",", unserialize($_COOKIE["favoris"]));

    require_once __DIR__."/../mode/article.php";

	$sql="SELECT * FROM article WHERE id IN (".$comma_separated.")";
	$requete=$connexion->prepare($sql);
	$requete->execute();
	$resultatfavoris=$requete->fetchAll(PDO::FETCH_CLASS,"article");
	

}


