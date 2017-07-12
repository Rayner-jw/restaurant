<?php
	require_once('connect.php');
	$file = $_FILES['file'];//获得图片文件
	$name = $file['name'];
	$typename = $_POST['typename'];
	$foodname = $_POST['foodname'];
	$foodprice = $_POST['foodprice'];
	if(!is_uploaded_file($file['tmp_name'])){
	   //如果不是HTTP POST上传的
	   return ;
	}
	$upload_path = "E:/JunWei/JW-web/www/jwww/res_admin/upload_img/"; 
	//移动文件到指定的文件夹
	//加入数据库
	if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
		$insert="insert into foods(food_name,food_type,food_price,food_image) values('".$foodname."','".$typename."','".$foodprice."','".$file['name']."')";
		if($pdo->exec($insert)){
			echo "<script>alert('添加成功');window.location.href='home.php'</script>";	
		}
			
	}else{
		echo "Failed!";
	}
?>