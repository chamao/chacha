<?php
$mod = 'blank';
include("./include/common.php");
$title = '茶茶商城系统后台';
include './head.php';
if ($islogin == 1) {
} else exit("<script language='javascript'>window.location.href='./login.php';</script>"); //判断账号是否登录，未登录跳转到登录页面
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
        <li class="active">
          <a href="./"><span class="glyphicon glyphicon-user"></span> 后台首页</a>
        </li>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 商品管理<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./add.php">添加商品</a>
            <li>
            <li><a href="./list.php">商品列表</a></li>
            <li><a href="./search.php">搜索商品</a>
            <li>
          </ul>
        </li>
        <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 用户管理<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./useradd.php">添加用户</a>
            <li>
            <li><a href="./userlist.php">用户列表</a></li>
            <li><a href="./usersearch.php">搜索用户</a>
            <li>
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
<?php
$sum = $DB->count("SELECT count(*) from product WHERE 1");
$yhsum = $DB->count("SELECT count(*) from user WHERE 1");
$ddsum = $DB->count("SELECT count(*) from `order` WHERE 1");
?>
<div class="container" style="padding-top:70px;">
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">后台首页</h3>
      </div>
      <ul class="list-group">
        <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>商品统计：</b> 共 <?= $sum ?> 个商品</li>
        <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>用户统计：</b> 共 <?= $yhsum ?> 个用户</li>
        <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>订单统计：</b> 共 <?= $ddsum ?> 个订单</li>
        <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>现在时间：</b> <?= $date ?></li>
        <li class="list-group-item"><span class="glyphicon glyphicon-tint"></span> <b>欢迎你：</b> 超级管理员</li>
        <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>功能菜单：</b>
          <a href="./add.php" class="btn btn-xs btn-success">添加商品</a>
          <a href="./useradd.php" class="btn btn-xs btn-success">添加用户</a>
          <a href="./passwd.php" class="btn btn-xs btn-success">修改密码</a>
        </li>
      </ul>
    </div>
  </div>
</div>