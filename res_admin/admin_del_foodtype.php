<?php
	require_once('connect.php');
	$del_type = $_POST['del_type'];
	$dellect = "delete FROM foods where food_type='".$del_type."'";
	$del = $pdo->prepare($dellect);
	$del->execute();
	echo '{"aa":false,"d":"参数错误"}';
?>