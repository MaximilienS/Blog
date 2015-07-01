<?php


include "config/config.inc.php";


$tabs=serialize(["test"]);
// echo $tabs;
// var_dump(unserialize($tabs));
//die;

setcookie("test","3wa",strtotime("+1 DAYS"), "/", false, false, true);
//var_dump($_COOKIE);
//die();
//unset($_COOKIE["favoris"]);
// setcookie("test", null, -1, "/");







$currentPage="accueil";
if (empty($_GET["page"])==false)
{
	$currentPage=$_GET["page"];
};

$controller =  "controller/".$currentPage."Controller.php";
$vue = "vues/".$currentPage."Vue.phtml";

if (file_exists($controller)==false || file_exists($vue)==false)
{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not found");
	include"vues/404.phtml";
	die();
}
include $controller;
include$vue;