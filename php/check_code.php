<?php




$mailto=$_POST["email"];
$code=$_POST["code"];
$new_password=$_POST["new_password"];

$a = "chache/$mailto.txt";

$b= fopen($a, "r");

$file_code=0;

while(!feof($b))
{
    $file_code = fgets($b);
}

if ($file_code == $code) {
            $servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";


        $conn = new mysqli($servername, $username, $password,$database_name);
        
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        } 

        $new_password = md5($new_password);
        $sql = "UPDATE user SET password='$new_password' WHERE email='$mailto';";
        mysqli_query($conn,$sql);

        echo "修改成功";
    }
else{
    echo("验证失败");
}


?>