<?php
// 登录页面
$mod = 'blank';
include("./include/common.php");
$title = '管理登录';
include './head.php';
?>
<!-- 导航栏 -->
<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">导航按钮</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">茶茶商城系统后台</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active">
          <a href="./login.php"><span class="glyphicon glyphicon-user"></span> 管理登录</a>
        </li>
        <li>
          <a href="../"><span class="glyphicon glyphicon-home"></span> 返回首页</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- 导航栏 -->

<div class="container" style="padding-top:70px;">
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <?php
    // 账号验证
    if (isset($_POST['user']) && isset($_POST['pass'])) { //判断字符是否为空
      $user = daddslashes($_POST['user']); //在指定的预定义字符前添加反斜杠
      $user_name = $user;
      $pass = daddslashes($_POST['pass']);
      $pass = md5($pass); //md5加密
      $auth = $_POST['auth'];
      $row = $DB->get_row("SELECT * FROM admin WHERE user='$user'"); //在admin表中查询账号信息
      if ($row['user'] == '') { //判断账号是否为空
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('此用户不存在');history.go(-1);</script>");
      } elseif ($pass != $row['pass']) { //判断密码是否正确
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
      } elseif ($row['user'] == $user && $row['pass'] == $pass) {
        $session = md5($user . $pass . $password_hash); //使用md5加密把用户信息存储在本地
        $token = authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY); //存储用户信息
        setcookie("admin_token", $token, time() + 7200); //信息存储最长时间
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('登陆后台成功！');window.location.href='./';</script>");
      }
    } elseif (isset($_GET['logout'])) {
      setcookie("admin_token", "", time() - 7200);
      @header('Content-Type: text/html; charset=UTF-8');
      exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
    } elseif ($islogin == 1) {
      exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
    }
    ?>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">管理登录</h3>
      </div>
      <div class="panel-body">
        <form action="./login.php" method="post" class="form-horizontal" role="form">
          <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" name="user" value="<?php echo @$_POST['user']; ?>" class="form-control" placeholder="用户名" required="required" />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" name="pass" class="form-control" placeholder="密码" required="required" />
          </div><br />
          <div class="form-group">
            <div class="col-xs-12"><input type="submit" value="登陆" class="btn btn-primary form-control" /></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>