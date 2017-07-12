<?php
	header("Content-Type:text/html;charset:utf-8;");
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=restaurant_bootstrap","root","");
	}catch(PDOException $e){
		echo "连接错误".$e->getMessage();
		exit;
	}
?>

