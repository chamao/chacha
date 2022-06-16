<?php
$id = $_POST["id"];

$servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";

$conn = new mysqli($servername, $username, $password,$database_name);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 


$sql = 'select * from product where id = '.$id;
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) > 0){  
    $temp_arr = array();
    while($row = mysqli_fetch_assoc($result)){  
        
        
    //    echo "EMP ID :{$row['id']}  <br> ".  
   
    //         "EMP NAME : {$row['name']} <br> ".  
   
    //         "EMP PRICE : {$row['price']} <br> ".  

    //         "EMP RESUME : {$row['resume']} <br> ".  

    //         "EMP INTRODUCE : {$row['introduce']} <br> ".  

    //         "EMP PIC : {$row['pic']} <br> ".  

    //         "EMP DATE : {$row['date']} <br> ". 
   
    //         "--------------------------------<br>";  
            $temp_arr["id"] = $row['id'];
            $temp_arr["name"] = $row['name'];
            $temp_arr["price"] = $row['price'];
            $temp_arr["resume"] = $row['resume'];
            $temp_arr["introduce"] = $row['introduce'];
            $temp_arr["pic"] = $row['pic'];
            $temp_arr["date"] = $row['date'];
        
   
    } 

    $page_arr = json_encode($temp_arr,JSON_UNESCAPED_UNICODE);
    echo $page_arr;

}

?>