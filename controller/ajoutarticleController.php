<?php
if (empty($_SESSION["logged"])==true){
	header("location:index.php?page=connexion");
}

require_once __DIR__."/../mode/categories.php";

$sql= "SELECT * FROM categories";
$requete=$connexion->prepare($sql);
$requete->execute();
$resultatUnecategorie=$requete->fetchAll(PDO::FETCH_CLASS, "Categories");


$errors = [];


if (empty($_POST)== false){

	if (empty($_POST["Titre"])) 
		{
			array_push($errors, "Veuillez entrer votre titre");
		}
	
	if (empty($_POST["description"])) 
		{
			array_push($errors, "Veuillez entrer une description");
		}
	
	if (empty($_POST["auteur"])) 
		{
			array_push($errors, "Veuillez entrer un auteur");
		}
	if (empty($_FILES["image"])==true || $_FILES["image"]["error"]>0) 
		{
			array_push($errors, "Veuillez entrer une image");
		}
		else
		{
			$extensionvalider=["jpg","jpeg","png"];
			$extensionImage=str_replace("image/", "", $_FILES["image"]["type"]);
			
				if(in_array($extensionImage,$extensionvalider)==false)
				{
					array_push($errors,"veuillez uploader une image valide");
				}
		}

		// var_dump($_POST);
		// var_dump($_FILES);
		// var_dump($errors);
	if (empty($errors)) 
		{
			$monimage = uniqid().'.'.$extensionImage;
			$resultatUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], "vues/img/".$monimage);												
			//move_uploaded_file($_FILES["image"]["tmp_name"], "vues/img/".$_FILES["image"]["name"]);
			//pour afficher les erreurs
			if ($resultatUnecategorie == true)
			{
				$sql="INSERT INTO article (titre, description, date_article,image, id_categorie)
					VALUES(:valuetitre, :valuedescription, NOW(), :valueimage, :valueid_categorie)";
				$requete= $connexion->prepare($sql);
				//pour sécuriser sa base de données des utilisateurs
				$requete->bindvalue(":valuetitre", $_POST["Titre"]);
				$requete->bindvalue(":valuedescription", $_POST["description"]);
				//$requete->bindvalue(":valuedate_article", $_POST["date"]);

				$requete->bindvalue(":valueimage", $monimage);
				$requete->bindvalue(":valueid_categorie", $_POST["categorie"]);

				$success=$requete->execute();
			}
		}
			
};