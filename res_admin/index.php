<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>开始</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <div class="wrap">
        <img class="img-circle" src="image/index_logo.jpeg" />
        <main>
                <a class="btn btn-lg btn-default login">管理员登录</a>           
                <div class="manager_login">
                    <h4>管理员登录</h4>
                    <form action="login.php" method="post">
                        <input type="text" name="name" placeholder="用户账号" value="" required>
                        <input type="password" name="password" placeholder="密码" value="" required>
                        <button type="submit" name="submit" class="btn-link"><span class="glyphicon glyphicon-chevron-right"></span></button>
                    </form>
                </div>
        </main>
    </div>
    <script src="js/jquery1.9.1/jquery.js"></script>
    <script>
        /*index登录*/
        $('.login').click(function () {
            if($('.manager_login').css('display') == "none"){
                $('.manager_login').show();
            }else{
                $('.manager_login').hide();
            }
        });
    </script>
</body>
</html>