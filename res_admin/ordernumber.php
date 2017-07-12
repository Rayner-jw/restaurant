<?php
	require_once('connect.php');
	$all_ordered = "SELECT * FROM bills";
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
                <li><a href="">订单</a></li>
            </ul>
        </nav>
        <div class="ordered">
            <div class="cent">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>订单号</td>
                            <td>桌号</td>
                            <td>总价</td>
                        </tr>
                    </thead>
					
					<?php 						
						if(!empty($data)){
							foreach($data as $value){
								$orderNumer=$value['b_o_t_orderNum'];
								$order_t_num=$value['bill_o_t_num'];								 
					?>
                    <tr class="one_bill">
                        <td><?php echo $value['b_o_t_orderNum']?></td>
                        <td><?php echo $value['bill_o_t_num']?></td>
                        <td><?php echo $value['bill_prices']?></td>
						
                    </tr>
					<tr class="detials">
						<td colspan="3">
							<table class="table table-bordered text-center">              
								<tr>
									<td>菜品编号</td>
									<td>数量</td>
									<td>小计</td>
								</tr>                
								<?php
									$all_ordered = "SELECT * FROM ordered_list where ordered_o_t_orderNum=$orderNumer and ordered_o_t_num=$order_t_num";
									$pres = $pdo->prepare($all_ordered);
									$pres->execute();
									while($val = $pres->fetch(PDO::FETCH_ASSOC)){
										//$details[]=$rows;
									//foreach($details as $val){
								?>
								 <tr>
									<td><?php echo $val['ordered_food_id']?></td>
									<td><?php echo $val['ordered_food_num']?></td>
									<td><?php echo $val['ordered_food_prices']?></td>
								</tr>
								<?php
									}
								?>
								<tr>
									<td colspan="3">
										<div class="ordered_price">
											<b>>>>>>>>>>>>>>>>>>>>>>>>></b>
											<strong>确认订单</strong>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
									
							}
						}
					?>
                </table>
				
            </div>
        </div>
    </div>
    <div class="footer">
		<nav class="navbar navbar-inverse navbar-fixed-bottom">
			<ul class="nav navbar-nav">
				<li><a href="index.php">登录</a></li>
				<li><a href="ordernumber.php">订单</a></li>
				<li><a href="home.php">管理</a></li>
				
			</ul>
		</nav>
	</div>
</div>
<script src="js/jquery1.9.1/jquery.js"></script>
<script src="js/main.js"></script>
</body>
</html>