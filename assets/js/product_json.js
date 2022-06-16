var data_cart="";
function add() {
    var a = document.getElementById("buy");
    b = parseInt(a.value)+ 1;
    a.value = b.toString();
}
function min() {
    var a = document.getElementById("buy");
    if (parseInt(a.value)<=0) {
        return 0;
    }
    b = parseInt(a.value)- 1;
    a.value = b.toString();
}


function add_cart() {
    urlinfo = window.location.href;  //获取当前页面的url
    console.log(urlinfo)
    len = urlinfo.split("?");//获取url的长度
    newsidinfo = len[1];//取出参数字符串 这里会获得类似“id=1”这样的字符串
    id = newsidinfo.split("=");
    ids = id[1];


    var a = document.getElementById("buy");
    var buy_num = document.getElementById("buy").value;

    data_cart["buy_num"] = buy_num;
    localStorage.setItem(ids,JSON.stringify(data_cart));
    alert("添加至购物车成功!")




    // localStorage.setItem("product_"+product_id, product_id);

    // localStorage.setItem("product_"+product_id+"_num", buy_num);

    // console.log(localStorage.getItem("product_"+product_id));

    // console.log(localStorage.getItem("product_"+product_id+"_num"));


}


$(document).ready(function(){



    urlinfo = window.location.href;  //获取当前页面的url
    console.log(urlinfo)
    len = urlinfo.split("?");//获取url的长度
    newsidinfo = len[1];//取出参数字符串 这里会获得类似“id=1”这样的字符串
    id = newsidinfo.split("=");
    ids = id[1];
    

    $.post("/php/detailed.php",
    {
        id:ids
    },
    function(data,status){
        console.log(data);
        obj = JSON.parse(data);
        product_div = document.getElementById("product_div");
        data_cart = obj;
        pic_s = obj['pic'].split(",");
        console.log(pic_s);

        document.getElementById("product_div").innerHTML=`
        <div class="row">
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12"><img class="img-thumbnail img-fluid center-block" src="${pic_s[0]}" ></div>
            </div>
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6"><img class="img-thumbnail img-fluid center-block" src="${pic_s[1]}"></div>
                <div class="col-6 col-sm-6 col-md-6"><img class="img-thumbnail img-fluid center-block" src="${pic_s[2]}"></div>
            </div>
        </div>
        <div class="col-md-5">
            <h1>${obj["name"]}</h1>
            <p>${obj["introduce"]}</p>
            <h2 class="text-center text-success"><i class="fa fa-dollar"></i> RMB ${obj["price"]}</h2>
            <div style="text-align: center;"><button class="btn btn-primary" type="button" style="margin: 0PX;" onclick="min()">-</button><input type="text" style="width: 10%;text-align: center;" value="0" id="buy"><button onclick="add()" class="btn btn-primary" type="button" style="margin: 0PX;">+</button><button class="btn btn-danger btn-lg center-block" type="button" onclick="add_cart()"><i class="fa fa-cart-plus"></i>&nbsp;添加到购物车</button></div>
        </div>
    </div>
        `
        

    });

})