<?php
	require_once('connect.php');
	$file = $_FILES['file_modify'];//获得图片文件
	$fid = $_POST['fid'];
	$modify_picname = $file['name'];
	$modifyname = $_POST['modify_name'];
	$modifyprice = $_POST['modify_price'];	
	//改了图片
	if(!empty($file['tmp_name'])){
		if(!is_uploaded_file($file['tmp_name'])){
		   //如果不是HTTP POST上传的
		   return ;
		}
		$upload_path = "E:/JunWei/JW-web/www/jwww/res_admin/upload_img/"; 
		//移动文件到指定的文件夹
		//加入数据库
		move_uploaded_file($file['tmp_name'],$upload_path.$file['name']);	
		$modify="update foods set food_name='".$modifyname."',food_price='".$modifyprice."',food_image='".$modify_picname."' where food_id='".$fid."'";
	}else{
		//没改图片
		$modify="update foods set food_name='".$modifyname."',food_price='".$modifyprice."' where food_id='".$fid."'";
	}
	if($pdo->exec($modify)){
		echo "<script>alert('修改成功');window.location.href='home.php'</script>";	
	}
?>