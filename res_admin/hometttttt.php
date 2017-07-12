<?php
	require_once('connect.php');
	/*搜索所有食物*/
	$all_food = "SELECT * FROM foods";
	$pre = $pdo->prepare($all_food);
	$pre->execute();
	while($row = $pre->fetch(PDO::FETCH_ASSOC)){
		$data[]=$row;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/home.css" />
</head>
<body>
    <div class="wrap">
        <span class="t_num badge"></span>
        <img src="image/home_logo.jpg" width="500px" height="80px" />
        <div class="content">
            <nav class="navbar navbar-inverse">
                <ul class="nav navbar-nav">
					<?php 
						/*搜索食物类型*/
						$food_type = "SELECT DISTINCT food_type FROM foods";
						$f_type = $pdo->prepare($food_type);
						$f_type->execute();
						$food_type1 = $f_type->fetch(PDO::FETCH_ASSOC);
					?> 
					
                    <li>
						<a href="#"><?php echo $food_type1['food_type']?></a>
						<span class="glyphicon glyphicon-remove-circle type_del"></span>
                        <div class="food food1">
							<?php 
								if(!empty($data)){
									foreach($data as $value){
										if($food_type1['food_type']==$value['food_type']){
							?>
							<form action="admin_modify_food.php" method="post" enctype="multipart/form-data">
								<figure class="food_area">
									<div><img class="img-thumbnail" src="<?php echo "upload_img/".$value['food_image']?>" /></div>
									<input id="file_modify" type="file" name="file_modify" accept="image/png, image/jpeg, image/gif, image/jpg"/>
									<label for="file_modify" class="change_pic">click to change pic</label>
									<figcaption>
										<input name="fid" value="<?php echo $value['food_id']?>" style="display:none">
										<input name="modify_name" class="modify_name" value="" style="display:none">
										<h4 contenteditable="true" name=""><?php echo $value['food_name']?></h4>
										<input name="modify_price" class="modify_price" value="" style="display:none">
										<span>价格：$&nbsp;<b name="" contenteditable="true"><?php echo $value['food_price']?></b></span>
										<input type="submit" class="btn btn-default btn-xs f_modify" value="确定">
									</figcaption>
								</figure>
							</form>
							<?php
										}
									}
								}
							?>
							
							
							
							
							
                        </div>
                    </li>
					<?php
						foreach($f_type as $food_types){
					?>
                    <li><a href="#"><?php echo $food_types['food_type']?></a>
					<span class="glyphicon glyphicon-remove-circle type_del"></span>
                        <div class="food">
							<?php 
								if(!empty($data)){
									foreach($data as $value){
										if($food_types['food_type']==$value['food_type']){
							?>
                            <figure class="food_area">
								<form action="admin_add_food.php" method="post" enctype="multipart/form-data">
									<div><img class="img-thumbnail" src="<?php echo "upload_img/".$value['food_image']?>" /></div>
									<input id="file_modify" type="file" name="file_modify" accept="image/png, image/jpeg, image/gif, image/jpg"/>
									<label for="file_modify" class="change_pic">click to change pic</label>
									<figcaption>
										<h4 contenteditable="true"><?php echo $value['food_name']?></h4>
										<span>价格：$&nbsp;<b contenteditable="true"><?php echo $value['food_price']?></b></span>
										<input type="button" class="btn btn-default btn-xs f_modify" value="确定">
									</figcaption>
								</form>
                            </figure>
							<?php
										}
									}
								}
							?>
                            
                        </div>
                    </li>
					<?php
						}
					?>
					<!--<li class="add_type">
						<span class="glyphicon glyphicon-plus"></span>
						<section class="add_type_content">
							<input size="4">
							<input type="button" class="btn btn-default btn-xs" value="添加">
						</section>
					</li>-->
                </ul>
				<span class="glyphicon glyphicon-chevron-down click_down"></span>
            </nav>
			<!--管理员点击添加的食物区 -->
			<span class="glyphicon glyphicon-plus add_food"></span>
			<section class="add_foodarea">
				<form action="admin_add_food.php" method="post" enctype="multipart/form-data">
					<input id="file" type="file" name="file" accept="image/png, image/jpeg, image/gif, image/jpg"/>
					<label for="file" class="pick_pic">选择图片</label>
					<div id="preview"></div>
					<div>
						<label for="">类别：<input type="text" placeholder="类别" size='6' name="typename" required></label>
						<label for="">菜名：<input type="text" placeholder="菜名" size='6' name="foodname" required></label>
						<label for="">价格：<input type="text" placeholder="价格" size='6' name="foodprice" required></label>
						<input type="submit" class="btn btn-default btn-xs addonefood" value="添加">
					</div>
				</form>
			</section>
			
        </div>
        <div class="footer">
            <nav class="navbar navbar-inverse navbar-fixed-bottom">
                <ul class="nav navbar-nav">
					<li><a href="index.php">登录</a></li>
                    <li><a href="home.html">管理</a></li>
                    <li><a href="ordernumber.php">订单</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="js/jquery1.9.1/jquery.js"></script>
    <script src="js/main.js"></script>
</body>
</html>