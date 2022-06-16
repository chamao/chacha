$(document).ready(function(){


    







    button_s()


    urlinfo = window.location.href;  //获取当前页面的url
    console.log(urlinfo)
    len = urlinfo.split("?");//获取url的长度
    newsidinfo = len[1];//取出参数字符串 这里会获得类似“id=1”这样的字符串
    console.log(newsidinfo);

    var index_page = 0;

    if (newsidinfo == undefined) {

        var index_page = 0;
        $.post("/php/product_api.php",
        {
            page:index_page,
        },
        function(data,status){
            document.getElementById("")
            obj = JSON.parse(data);
            button_s(obj["pages"]);
            post_json(obj);




   
        });

        
    }
    else{
        if (newsidinfo.search("page")!=-1) {
            temp = newsidinfo.split("=");
            var index_page = temp[1];


            $.post("/php/product_api.php",
            {
                page:index_page,
            },
            function(data,status){
                document.getElementById("")
                obj = JSON.parse(data);
                button_s(obj["pages"]);
                post_json(obj);

    
    
    
    
    
       
            });
            
            
        }
    }


    function button_s(pages) {
        button_div = document.getElementById("button_div");
        mark = 0;
        while (mark<pages) {
            mark = mark+1;
            button_div.innerHTML=button_div.innerHTML+`<a href = "/?page=${mark-1}"><button class="btn btn-primary border rounded-circle" type="button" style="background-color: #ff8000;color: rgb(0,0,0);" >${mark}</button></a>`;
        }

    }



    function post_json(obj) {
        var row1 = document.getElementById("row_1");
        console.log(obj);

        temp_mark = 1;
        start = index_page*6 +1;  //0 -> 1     1 ->7   2 -> 13
        end = (index_page+1)*6; //0 -> 6     1 ->12   2 -> 18
        while (start <=end) {
            index_pic = obj[start]["pic"];
            temp_a = index_pic.split(",");

            if (obj[start]["introduce"].length >120) {
                temp_text =obj[start]["introduce"].substring(0,150).replace(/&lt;br&gt;/g,'')+ "......";
            } else {
                temp_text = obj[start]["introduce"] + "......"
            }


            row1.innerHTML = row1.innerHTML + `           <div class="col-sm-6 col-md-4 product-item">
            <div class="product-container">
                <div class="row">
                    <div class="col-md-12"><a class="product-image" href="#"><img 

src="${temp_a[0]}"></a></div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h2><a href="#">${obj[start]["name"]}</a></h2>
                    </div>
                    <div class="col-4"><a class="small-text" href="#">电子产品

</a></div>
                </div>
                <div class="product-rating"><a class="small-text" 

href="#">${obj[start]["date"]}</a></div>
                <div class="row">
                    <div class="col-12">
                        <p class="product-description" style="">${temp_text}</p>
                        <div class="row">
                            <div class="col-6"><a href="product.html?id=${obj[start]["id"]}" 

target="_blank"><button class="btn btn-light" type="button">查看商品</button></a></div>
                            <div class="col-6">
                                <p class="product-price">${obj[start]["price"]}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
        start = start+1;

        }

        
    }



})