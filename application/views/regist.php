<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册</title>

<!--   路径  需要配置autoload.php的第92行 array('url')-->
    <base href="<?php echo site_url();?>">

    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
<!--点击注册 访问action的地址  控制器/方法-->
<form action="welcome/save" method="post">
    <p>
        用户名: <input type="text" name="username">
<!--        isset判断是否存在或为空  返回布尔 -->
<!--        如果有值 则是从welcome/save传过来的 则输出错误提示用户名不能为空，如果没有值 则没有进行验证 默认为空  刷新一进来的页面就是默认为空-->
        <span class="error"><?php echo isset($name_error)? $name_error:''?></span>
    </p>
    <p>
        密码: <input type="password" name="pwd1">
        <span class="error"><?php echo isset($pwd_error)? $pwd_error:''?></span>
    </p>
    <p>
        确认密码: <input type="password" name="pwd2">
    </p>
    <p>
        <input type="submit" value="注册">
    </p>

</form>
</body>
</html>