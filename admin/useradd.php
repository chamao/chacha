<?php
// 用户添加页面
$mod = 'blank';
include("./include/common.php");
$title = '添加用户';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<!-- 导航 -->
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
          <li>
            <a href="./"><span class="glyphicon glyphicon-user"></span> 后台首页</a>
          </li>
          <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 商品管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./add.php">添加商品</a><li>
			  <li><a href="./list.php">商品列表</a></li>
			  <li><a href="./search.php">搜索商品</a><li>
            </ul>
          </li>
          <li class="active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 用户管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./useradd.php">添加用户</a><li>
			  <li><a href="./userlist.php">用户列表</a></li>
			  <li><a href="./usersearch.php">搜索用户</a><li>
            </ul>
          </li>
          <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 订单管理<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./ddlist.php">订单列表</a></li>
            <li><a href="./ddsearch.php">搜索订单</a>
            <li>
          </ul>
        </li>
		  <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> 系统管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
			  <li><a href="./passwd.php">修改密码</a></li>
            </ul>
          </li>
          <li><a href="./login.php?logout"><span class="glyphicon glyphicon-off"></span> 退出管理</a></li>
        </ul>
      </div> 
    </div>
  </nav>
  <!-- 导航 -->
<div class="container" style="padding-top:70px;">
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <?php
    if (isset($_POST['name']) && isset($_POST['pass']) ) {
      $name=$_POST['name'];
      $pass=$_POST['pass'];
      $pass=md5($pass);
      $row = $DB->get_row("SELECT * FROM user WHERE email='$name' limit 1");
      if ($row != '') exit("<script language='javascript'>alert('后台已存在该用户！');history.go(-1);</script>");
      $sql = "INSERT INTO user (email,password) VALUES ('$name','$pass')";
      $DB->query($sql);
      exit("<script language='javascript'>alert('添加成功');window.location.href='userlist.php';</script>");
    } ?>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">添加用户</h3>
      </div>
      <div class="panel-body">
        <form action="./useradd.php" method="post" class="form-horizontal" role="form">
          <div class="input-group">
            <span class="input-group-addon">用户名</span>
            <input type="text" name="name" class="form-control" placeholder="123@qq.com" autocomplete="off" required />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon">密码</span>
            <input type="text" name="pass" class="form-control" placeholder="123456" autocomplete="off" required />
          </div><br />
          <form class="form-horizontal required-validate" action="${ctx}/save?callbackType=confirmTimeoutForward" enctype="multipart/form-data" method="post" οnsubmit="return iframeCallback(this, pageAjaxDone)">
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" value="添加" class="btn btn-primary form-control" /></div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>