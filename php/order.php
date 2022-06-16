<?php
    $email = $_POST["email"];


    $servername = "localhost";
        $username = "xxxx";
        $password = "a151251551";
        $database_name = "xxxx";
    $conn = new mysqli($servername, $username, $password,$database_name);
    
    // 检测连接
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    } 
    $arr = array();

    $sql = "SELECT * FROM `order` WHERE email='$email';";
    $result = mysqli_query($conn,$sql);
    $count = 0;
    if(mysqli_num_rows($result) > 0){  

        while($row = mysqli_fetch_assoc($result)){  
            $temp_arr = array();
            $temp_arr['id'] = $row['id'];
            $temp_arr['email'] = $row['email'];
            $temp_arr['order_name'] = $row['order_name'];
            $temp_arr['order_price'] = $row['order_price'];
            $temp_arr['order_product_id'] = $row['order_product_id'];
            $temp_arr['order_num'] = $row['order_num'];
            $temp_arr['address'] = $row['address'];

            $temp_arr['date'] = $row['date'];

            $temp_arr['status'] = $row['status'];

            $count = $count +1;
            $arr[$count] = $temp_arr;
            
            
       
        } 


       
    
    
        
       }else{  
       
       echo "0 results";  
       
       }  

       mysqli_close($conn);
       $page_arr = json_encode($arr,JSON_UNESCAPED_UNICODE);
       print_r($page_arr);

?>