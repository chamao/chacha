<?php
// 商品添加页面
$mod = 'blank';
include("./include/common.php");
$title = '添加商品';
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
          <li class="active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 商品管理<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./add.php">添加商品</a><li>
			  <li><a href="./list.php">商品列表</a></li>
			  <li><a href="./search.php">搜索商品</a><li>
            </ul>
          </li>
          <li>
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
    if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['resume'])&& isset($_POST['introduce'])&& isset($_POST['pic'])) {
      $name=$_POST['name'];
      $price=$_POST['price'];
      $resume=$_POST['resume'];
      $introduce=$_POST['introduce'];
      $pic=$_POST['pic'];
      $spdate = date("Y-m-d");
      $row = $DB->get_row("SELECT * FROM product WHERE name='$name' limit 1");
      if ($row != '') exit("<script language='javascript'>alert('后台已存在该商品！');history.go(-1);</script>");
      $sql = "INSERT INTO product (name,price,resume,introduce,pic,date) VALUES ('$name','$price','$resume','$introduce','$pic','$spdate')";
      $DB->query($sql);
      exit("<script language='javascript'>alert('添加成功');window.location.href='list.php';</script>");
    } ?>
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">添加商品</h3>
      </div>
      <div class="panel-body">
        <form action="./add.php" method="post" class="form-horizontal" role="form">
          <div class="input-group">
            <span class="input-group-addon">商品名称</span>
            <input type="text" name="name" class="form-control" placeholder="Iphone12" autocomplete="off" required />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon">商品价格</span>
            <input type="text" name="price" class="form-control" placeholder="4699.00" autocomplete="off" required />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon">商品简介</span>
            <input type="text" name="resume" class="form-control" placeholder="ios15急速体验" autocomplete="off" required />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon">商品详情</span>
            <input type="text" name="introduce" class="form-control" placeholder="iPhone 12双镜头后置摄像头系统，配备1200万像素超广角和广角镜头以及7元件镜头；iPhone 12支持5G，搭载A14Bionic芯片，支持北斗导航；iPhone 12分辨率为2532x1170，对比度为200万:1，亮度1200尼特。" autocomplete="off" required />
          </div><br />
          <div class="input-group">
            <span class="input-group-addon">商品图片链接</span>
            <input type="text" name="pic"class="form-control" placeholder="img/realme1.jpg,img/realme2.jpg,img/realme3.jpg" autocomplete="off" required />
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