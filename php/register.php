<?php
$email = $_POST["email"];
$password = $_POST["password"];

$servername = "localhost";
        $username = "xxxx";
        $password_data = "a151251551";
        $database_name = "xxxx";


$conn = new mysqli($servername, $username, $password_data,$database_name);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
echo "连接成功";

$sql = "SELECT email FROM user WHERE email='$email'"; //SQL语句
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result); //统计执行结果影响的行数
if($num)    //如果已经存在该用户
{
    echo "用户名已存在";
}
else    //不存在当前注册用户名称
{
    $temp_md5 = md5($password);
    $sql_insert = "insert into user (email,password) values('$email','$temp_md5')";
    $res_insert = mysqli_query($conn,$sql_insert);
    if($res_insert)
    {
        // echo "<script>alert('注册成功！'); history.go(-1);</script>";
        echo "注册成功";
    }
    else
    {
        echo "系统繁忙，请稍候!";
    }
}



?>