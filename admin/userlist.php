<?php
$mod = 'blank';
include("./include/common.php");
$title = '用户列表';
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
<div class="container" style="padding-top:70px;width:100%;">
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <?php
    if (isset($_GET['name'])) {
      $sql = ($_GET['method'] == 1) ? " `email` LIKE '%{$_GET['name']}%'" : " `email`='{$_GET['name']}'";
      $gls = $DB->count("SELECT count(*) from user WHERE{$sql}");
      $con = '名称包含' . $_GET['name'] . ' 的共有 <b>' . $gls . '</b> 个用户';
    } else {
      $gls = $DB->count("SELECT count(*) from user WHERE 1");
      $sql = " 1";
      $con = '后台共有 <b>' . $gls . '</b> 个用户';
    }

    $pagesize = 30;
    if (!isset($_GET['page'])) {
      $page = 1;
      $pageu = $page - 1;
    } else {
      $page = $_GET['page'];
      $pageu = ($page - 1) * $pagesize;
    }

    echo $con;
    ?>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $rs = $DB->query("SELECT * FROM user WHERE{$sql} order by id");
          while ($res = $DB->fetch($rs)) {
            echo '<tr><td>' . $res['id'] . '</td><td>' . $res['email'] . '</td><td><a href="./useredit.php?my=update&id=' . $res['id'] . '" class="btn btn-xs btn-info">修改</a> <a href="./useredit.php?my=del&id=' . $res['id'] . '" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除这个用户吗？\');">删除</a></td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
    <?php
    echo '<ul class="pagination">';
    $s = ceil($gls / $pagesize);
    $first = 1;
    $prev = $page - 1;
    $next = $page + 1;
    $last = $s;
    if ($page > 1) {
      echo '<li><a href="list.php?page=' . $first . $link . '">首页</a></li>';
      echo '<li><a href="list.php?page=' . $prev . $link . '">&laquo;</a></li>';
    } else {
      echo '<li class="disabled"><a>首页</a></li>';
      echo '<li class="disabled"><a>&laquo;</a></li>';
    }
    for ($i = 1; $i < $page; $i++)
      echo '<li><a href="list.php?page=' . $i . $link . '">' . $i . '</a></li>';
    echo '<li class="disabled"><a>' . $page . '</a></li>';
    for ($i = $page + 1; $i <= $s; $i++)
      echo '<li><a href="list.php?page=' . $i . $link . '">' . $i . '</a></li>';
    echo '';
    if ($page < $s) {
      echo '<li><a href="list.php?page=' . $next . $link . '">&raquo;</a></li>';
      echo '<li><a href="list.php?page=' . $last . $link . '">尾页</a></li>';
    } else {
      echo '<li class="disabled"><a>&raquo;</a></li>';
      echo '<li class="disabled"><a>尾页</a></li>';
    }
    echo '</ul>';
    #分页
    ?>
  </div>
</div>