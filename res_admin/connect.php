<?php
	header("Content-Type:text/html;charset:utf-8;");
	try{
		$pdo = new PDO("mysql:host=localhost;dbname=restaurant_bootstrap","root","");
	}catch(PDOException $e){
		echo "���ݿ�����ʧ�ܣ�".$e->getMessage();
		exit;
	}
?>

