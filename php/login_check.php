<?php
$email = $_POST["email"];
$password = $_POST["password"];

$servername = "localhost";
        $username = "xxxx";
        $data_password = "a151251551";
        $database_name = "xxxx";


$conn = new mysqli($servername, $username, $data_password,$database_name);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 


$sql = "select email,password from user where email = '$email' and password = '$password'";


$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num)
{
    $row = mysqli_fetch_array($result);  //将数据以索引方式储存在数组中
    echo "邮箱".$row[0]."登录成功";
}
else
{
    echo "用户名或密码不正确！";
}


?>