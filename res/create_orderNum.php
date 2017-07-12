<?php
	/*为桌号创建随机订单号*/
	require_once('connect.php');
	session_start();
	session_destroy();
	$orderNumber = rand(1000,9999);
	$tableNum = intval($_POST['tableNum']);
	$insert="insert into order_tables(o_t_orderNum,o_t_num) values($orderNumber,$tableNum)";
	$ins = $pdo->prepare($insert);
	$ins->execute();
	session_start();
	$_SESSION['ORDERNUMBER']=$orderNumber;
	$code_arr = json_encode(array('orderNumber'=>$orderNumber));
	echo $code_arr;
?>