<?php
    $order = $_POST['order'];
    $email = $_POST['email'];
    $order_name = $_POST['order_name'];
    $order_num = $_POST['order_num'];
    $order_price = $_POST['order_price'];
    $order_product_id = $_POST['order_product_id'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    
    $email = $_POST["email"];
    $password = $_POST["password"];

        $servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";


$conn = new mysqli($servername, $username, $password,$database_name);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 


$sql = "INSERT INTO `xxxx`.`order` (`id`, `email`, `order_name`, `order_num`, `order_price`, `order_product_id`, `address`, `date`, `status`) VALUES ('$order', '$email', '$order_name', $order_num, $order_price, $order_product_id, '$address', '$date', 'no');";

$result = mysqli_query($conn,$sql);



    
    

?>