<?php
header('content-type:text/html;charset=utf-8');  
$page = $_POST["page"];


$servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";
$conn = new mysqli($servername, $username, $password,$database_name);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

$count = 0;

$arr = array("pages" => "0",);


$sql = 'SELECT * FROM product';
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){  

    while($row = mysqli_fetch_assoc($result)){  
        $temp_arr = array();
        
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

            $count = $count +1;
            $arr[$count] = $temp_arr;
        
   
    } 
   


    
   }else{  
   
   echo "0 results";  
   
   }  

   mysqli_close($conn);

   $temp = ceil($count/6);

   
   
   
   

   
   if ($page >=$temp) {
    echo "已经没有商品啦！";
   } 
   else{
    $page_arr = array(); 
    $start = $page*6 +1;  //0 -> 1     1 ->7   2 -> 13
    $end = ($page+1)*6; //0 -> 6     1 ->12   2 -> 18

    while ($start <= $end) {
        $page_arr[$start] = $arr[$start];
        $start = $start +1;
    }
   }

   $temp = ceil($count/6);
   $page_arr["pages"] =$temp; 

   $page_arr = json_encode($page_arr,JSON_UNESCAPED_UNICODE);



   print_r($page_arr);
?>