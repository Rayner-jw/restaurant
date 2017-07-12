<?PHP
    require_once('connect.php');
	//检测提交操作
    if(!isset($_POST["submit"])){
        exit("错误执行");
    }
    $admin_name = $_POST['name'];
    $admin_psd = $_POST['password'];
	
    if($admin_name && $admin_psd){
		$sql = "select username,password from administer where username=$admin_name and password=$admin_psd";
		$pre = $pdo->prepare($sql);
		$row = $pre->execute();
		if($row){
			header("refresh:0;url=ordernumber.php");
			exit;
		}else{
			echo "用户名或密码错误";
			echo "<script>setTimeout(function(){window.location.href='index.php';},1000);</script>";
		}
    }else{
        echo "表单填写不完整";
        echo "<script>setTimeout(function(){window.location.href='index.php';},1000);</script>";                 
    }

?>