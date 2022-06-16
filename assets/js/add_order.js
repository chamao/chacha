  $(document).ready(function(){
    alert("ASD");
      mark = 0;
           urlinfo = window.location.href;  //获取当前页面的url
            console.log(urlinfo)
            len = urlinfo.split("?");//获取url的长度
            newsidinfo = len[1];//取出参数字符串 这里会获得类似“id=1”这样的字符串
            get_data = newsidinfo.split("&");
            console.log(get_data);
        while (localStorage.key(mark)!=null) {
            var temp = JSON.parse(localStorage.getItem(localStorage.key(mark)));
            var a_p = parseInt(temp["buy_num"]);
            var b_p = parseInt(temp["buy_num"]);
            var p = String(a_p*b_p);
               $.post("/php/receive_order.php",
                {
                    
                    order:(get_data[2].split("="))[1],
                    email:temp["email"],
                    order_name:temp["name"],
                    order_num:temp["buy_num"],
                    order_price:p,
                    
                    order_product_id:temp["id"],
                    
                    address:temp["address"],
                    
                    date:temp["buy_date"],
                    
                    
                },
                function(data,status){
                    
                    
                    
                })
            mark = mark+1;
        }
    
    
    
    
        mark = 0;
        while (localStorage.key(mark)!=null) {
            localStorage.removeItem(localStorage.key(mark));
            mark = mark+1;
        }
})