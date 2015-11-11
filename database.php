<?php
// Create connection and call queries using PDO

require('config.php');

/*if(!isset($_GET['search'])){
	die();
}*/

$search = $_GET['search'];

echo $search;
echo "is this working ?";

$datab = 'countries';
$db = new PDO('mysql:host='.DB_SERVER, DB_USER, DB_PASSWORD);
	$db->exec("CREATE DATABASE `$datab`");

$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);		$sql = file_get_contents('install.sql');
	$db->exec($sql);

try{
	$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $db->prepare("SELECT name_en as country FROM `country` WHERE name_en LIKE ? ORDER BY country");
	$search = $search . '%';
	$stmt->bindParam(1, $search, $keyword, PDO::PARAM_STR, 100);
	$stmt->execute();
	$result = array();
	$result = $stmt->fetchAll(PDO::FETCH_COLUMN);

}
catch (PDOException $e)
	{
		echo "Error:" . $e->getMessage();
	}
$db=null;

echo json_encode($result);
?>