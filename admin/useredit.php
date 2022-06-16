<?php
$mod = 'blank';
include("./include/common.php");
$title = '用户修改';
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
        <li >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-pushpin"></span> 商品管理<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./add.php">添加商品</a>
            <li>
            <li><a href="./list.php">商品列表</a></li>
            <li><a href="./search.php">搜索商品</a>
            <li>
          </ul>
        </li>
        <li class="active">
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
<div class="container" style="padding-top:70px;">
  <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
    <?php
    if ($_GET['my'] == 'update') {
      $id = intval($_GET['id']);
      $row = $DB->get_row("SELECT * FROM user WHERE id='$id'");
      if ($row == '') exit("<script language='javascript'>alert('后台不存在该用户！');history.go(-1);</script>");
      if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $pass = md5($pass);
        $sql = "update user set email ='$name',password='$pass' where `id`='{$id}'";
        if ($DB->query($sql)) {
          showmsg('修改成功！', 1, $_POST['backurl']);
        } else showmsg('修改失败！<br/>' . $DB->error(), 4, $_POST['backurl']);
      } else {
    ?>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">修改用户</h3>
          </div>
          <div class="panel-body">
            <form action="./useredit.php?my=update&id=<?php echo $id; ?>" method="post" class="form-horizontal" role="form">
              <input type="hidden" name="backurl" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
              <div class="input-group">
                <span class="input-group-addon">用户名</span>
                <input type="text" name="name" value="<?php echo $row['email']; ?>" class="form-control" placeholder="123@qq.com" autocomplete="off" required />
              </div><br />
              <div class="input-group">
                <span class="input-group-addon">密码</span>
                <input type="text" name="pass" class="form-control" placeholder="123456" autocomplete="off" required />
              </div><br />
              <form class="form-horizontal required-validate" action="${ctx}/save?callbackType=confirmTimeoutForward" enctype="multipart/form-data" method="post" οnsubmit="return iframeCallback(this, pageAjaxDone)">
                <div class="form-group">
                  <div class="col-sm-12"><input type="submit" value="修改" name="submit" class="btn btn-primary form-control" /></div>

                </div>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">返回用户列表</a>
          </div>
          </form>
        </div>
  </div>
<?php
      }
    } elseif ($_GET['my'] == 'del') {
      $id = intval($_GET['id']);
      $sql = "DELETE FROM user WHERE id='$id' limit 1";
      if ($DB->query($sql)) {
        showmsg('删除成功！', 1, $_SERVER['HTTP_REFERER']);
      } else showmsg('删除失败！<br/>' . $DB->error(), 4, $_SERVER['HTTP_REFERER']);
    } ?>

</div>
</div>