<?php
	require_once('connect.php');
	$foodId = intval($_POST['foodId']);
	$tableNum = intval($_POST['tableNum']);
	$ordernumber = intval($_POST['ordernumber']);
	
	/*取单价*/
	$sqls = "SELECT food_price FROM foods where food_id=$foodId";
	$pre = $pdo->prepare($sqls);
	$pre->execute();
	$data = $pre->fetch(PDO::FETCH_ASSOC);
	$price=intval($data['food_price']);
	
	/*搜索数量*/
	$o_f_id = "SELECT ordered_food_num FROM ordered_list where ordered_food_id=$foodId and ordered_o_t_orderNum=$ordernumber";
	$pres = $pdo->prepare($o_f_id);
	$pres->execute(); 
	$data=$pres->fetch(PDO::FETCH_ASSOC);
	$food_num=intval($data['ordered_food_num'])+1;
	/*更新数量*/
	$update = "update ordered_list set ordered_food_num=$food_num,ordered_food_prices=$food_num*$price where ordered_food_id=$foodId and ordered_o_t_orderNum=$ordernumber";
	$udp = $pdo->prepare($update);
	$udp->execute();
	$code_arr = json_encode(array('onefood_price'=>$price));
	echo $code_arr;
	
?>