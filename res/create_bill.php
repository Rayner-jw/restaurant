<?php
	require_once('connect.php');
	//session_start();
	//session_destroy();
	$bill_total_price = intval($_POST['bill_total_price']);
	$tableNum = intval($_POST['tableNum']);
	$ordernumber = intval($_POST['ordernumber']);
	//$dateline=time();
	/*生成bill*/
	$insert="insert into bills(b_o_t_orderNum,bill_o_t_num,bill_prices) values('".$ordernumber."','".$tableNum."','".$bill_total_price."')";
	$ins = $pdo->prepare($insert);
	$ins->execute();
	echo '{"aa":false,"d":"参数错误"}';
	
?>