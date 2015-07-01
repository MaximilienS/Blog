<?php

$id=$_GET["id"];
echo ($id);

setcookie("test","id",strtotime("+1 DAYS"), "/", false, false, true);
var_dump($_COOKIE);


if ( empty($_GET["id"]) == true)
{
	header("location:index.php");

}

if (empty($_COOKIE["favoris"]) == true)
{
	$favoris = [];
}
else
{
	var_dump($_COOKIE);
	var_dump($_COOKIE["favoris"]);
	$favoris=unserialize($_COOKIE["favoris"]);	

}



array_push($favoris,intval($_GET["id"]));
setcookie("favoris",serialize($favoris),strtotime("+1 DAYS"), "/", false, false, true);

header("Location:index.php?page=favoris");

