<?php
	require_once('connect.php');
	$foodId = intval($_POST['foodId']);
	$tableNum = intval($_POST['tableNum']);
	$ordernumber = intval($_POST['ordernumber']);
	$foodNum=1;
	/*取单价*/
	$sqls = "SELECT food_price FROM foods where food_id=$foodId";
	$pre = $pdo->prepare($sqls);
	$pre->execute();
	$data = $pre->fetch(PDO::FETCH_ASSOC);
	$price=intval($data['food_price']);
	/*存在则更新数量*/
	$o_f_id = "SELECT ordered_food_id,ordered_food_num FROM ordered_list where ordered_o_t_orderNum=$ordernumber";
	$pres = $pdo->prepare($o_f_id);
	$pres->execute(); 
	while($row=$pres->fetch(PDO::FETCH_ASSOC)){
			$datas[]=$row;
	}	
	$flag=false;
	if(!empty($datas)){
		foreach($datas as $value){
			if($foodId==$value['ordered_food_id']){
				$flag=true;
				$food_num=intval($value['ordered_food_num'])+1;
			}
		}
	}
	if($flag){
		/*更新数量*/
		$update = "update ordered_list set ordered_food_num=$food_num,ordered_food_prices=$food_num*$price where ordered_food_id=$foodId and ordered_o_t_orderNum=$ordernumber";
		$udp = $pdo->prepare($update);
		$udp->execute();
		echo '{"aa":false,"d":"参数错误"}';
	}else{
		/*插入一条新记录*/
		$insert="insert into ordered_list(ordered_food_id,ordered_food_num,ordered_food_prices,ordered_o_t_orderNum,ordered_o_t_num) values($foodId,$foodNum,$price,$ordernumber,$tableNum)";
		$ins = $pdo->prepare($insert);
		$ins->execute();
		echo '{"aa":false,"d":"参数错误"}';
	}
	
?>