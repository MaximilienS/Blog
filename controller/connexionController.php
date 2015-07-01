
<?php


			$dataSource="mysql:host=localhost; dbname=blog; charset=utf8";
			$login="root";
			$mdp="troiswa";
			$connexion= new PDO ($dataSource, $login, $mdp);
			$connexion-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

// var_dump($_POST);
$errors=[];

if (empty($_POST)== false){

	if (empty($_POST["login"])== true) 
		{
			array_push($errors, "<br>"."Veuillez entrer un email");
		}
		else if(filter_var($_POST["login"],FILTER_VALIDATE_EMAIL)==false)
		{
			array_push($errors, "Email non valide");
		}



	if (empty($_POST["password"])) 
		{
			array_push($errors, "<br>"."Veuillez entrer un mot de passe");
		}

if (empty($errors)) 
		{
            require_once __DIR__."/../mode/utilisateur.php";

			$sql="SELECT * FROM utilisateur WHERE email=:mail AND password=:mdp";
			$requete=$connexion->prepare($sql);
			$requete->bindvalue(":mail", $_POST["login"]);
			$requete->bindvalue(":mdp", sha1($_POST["password"]));
			$requete->execute();
			$user=$requete->fetch(PDO::FETCH_CLASS, "utilisateur");
			var_dump($user);

			if (empty($user)==false){
				//die('ok2');
				$_SESSION["logged"]=$user;
				header("Location:index.php");
				die();
			}


		}
			
	}


