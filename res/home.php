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
						foreach($f_type as $food_types){
					?> 
                    <li><a href="#"><?php echo $food_types['food_type']?></a>
                        <div class="food">
							<?php 
								if(!empty($data)){
									foreach($data as $value){
										if($food_types['food_type']==$value['food_type']){
							?>
                            <figure class="food_area">
                                <img class="img-thumbnail" src="<?php echo "../res_admin/upload_img/".$value['food_image']?>"/>
                                <figcaption>
                                    <h4><?php echo $value['food_name']?></h4>
                                    <span>价格：<?php echo '$'.$value['food_price']?></span>
                                    <a><span class="glyphicon glyphicon-plus-sign f_plus" data-this_f_id="<?php echo $value['food_id']?>"></span></a>
                                </figcaption>
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
                </ul>
				<span class="glyphicon glyphicon-chevron-down click_down"></span>
            </nav>
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
</script>
</body>
</html>