<?php
	require_once('connect.php');
	session_start();
	$number = $_SESSION['ORDERNUMBER'];
	//匹配订单号搜索所有数据
	$all_ordered = "SELECT * FROM ordered_list where ordered_o_t_orderNum=$number";
	$pre = $pdo->prepare($all_ordered);
	$pre->execute();
	while($row = $pre->fetch(PDO::FETCH_ASSOC)){
		$data[]=$row;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>已点</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/ordered.css"/>
</head>
<body>
<div class="wrap">
    <span class="t_num badge"></span>
    <img src="image/home_logo.jpg" width="500px" height="80px" />
    <div class="content">
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a href="">已点菜品</a></li>
            </ul>
        </nav>
        <div class="ordered">
            <div class="cent">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>已点菜品</td>
                            <td>数量</td>
                            <td>小计</td>
                        </tr>
                    </thead>
					<?php 
						$total_price = 0;
						if(!empty($data)){
							foreach($data as $value){
								$ordered_food_id=$value['ordered_food_id'];
								//由食物ID号在foods找到food_name
								$id_name = "SELECT food_name FROM foods where food_id=$ordered_food_id";
								$fid_name = $pdo->prepare($id_name);
								$fid_name->execute();
								$f_idname = $fid_name->fetch(PDO::FETCH_ASSOC)
					?>
                    <tr>
                        <td><?php echo $f_idname['food_name']?></td>
                        <td>
                            <a data-this_f_id="<?php echo $ordered_food_id?>"><span class="glyphicon glyphicon-minus-sign"></span></a>
                            <input class="food_num" type="text" value="<?php echo $value['ordered_food_num']?>" size="1">
							<a data-this_f_id="<?php echo $ordered_food_id?>"><span class="glyphicon glyphicon-plus-sign"></span></a>
                        </td>
                        <td><?php echo $value['ordered_food_prices']?></td>
                    </tr>
					<?php	
								$total_price += $value['ordered_food_prices'];
							}
						}
					?>
                </table>
                <div class="ordered_price">
                    <span>总价：$<b><?php echo $total_price?></b></span>
                    <strong>确认下单</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <nav class="navbar navbar-inverse navbar-fixed-bottom">
            <ul class="nav navbar-nav">
                <li><a href="index.php">开始</a></li>
                <li><a href="home.php">首页</a></li>
                <li><a href="ordered.php">已点</a><span class="badge">0</span></li>
            </ul>
        </nav>
    </div>
</div>
<script src="js/jquery1.9.1/jquery.js"></script>
<script src="js/main.js"></script>
<script>
	if(sessionStorage.getItem('ORDERED_NUM')){
		$('.footer .badge').text(sessionStorage.getItem('ORDERED_NUM'));
	}
	$('.ordered_price strong').click(function(){
		$tableNum = localStorage.getItem('TABLE_NUM');
		$ordernumber = localStorage.getItem('ORDER_NUMBER');
		$bill_total_price = $('.ordered_price b').text();
		sessionStorage.removeItem('TABLE_NUM');
		$.ajax({ 
			type: "POST", 	
			url: "create_bill.php",
			dataType: "json",
			data: {
				'bill_total_price': $bill_total_price,
				'tableNum':$tableNum,
				'ordernumber':$ordernumber
			},
			success: function(data) {
				window.location.href="index.php";					
			},
			error: function(jqXHR){     
				alert("发生错误：" + jqXHR.status);  
			}    
		});
		
	});
</script>
</body>
</html>