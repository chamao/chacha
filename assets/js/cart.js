function getCookie(cname)
{
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) 
  {
    var c = ca[i].trim();
    if (c.indexOf(name)==0) return c.substring(name.length,c.length);
  }
  return "";
}

function CurentTime()  
{   
    var now = new Date();  
         
    var year = now.getFullYear();       //年  
    var month = now.getMonth() + 1;     //月  
    var day = now.getDate();            //日  
         
    var hh = now.getHours();            //时  
    var mm = now.getMinutes();          //分  
    var ss=now.getSeconds();            //秒  
         
    var clock = year + "-";  
         
    if(month < 10) clock += "0";         
    clock += month + "-";  
         
    if(day < 10) clock += "0";   
    clock += day + " ";  
         
    if(hh < 10) clock += "0";  
    clock += hh + ":";  
  
    if (mm < 10) clock += '0';   
    clock += mm+ ":";  
          
    if (ss < 10) clock += '0';   
    clock += ss;  
  
    return(clock);   
}  

function delete_p(id) {
    localStorage.removeItem(id);
    window.location.href='/cart.html';
    
}


function post_from() {
    price = parseFloat(document.getElementById("all_money").innerHTML);
    console.log(price);
    var amount =  parseFloat(document.getElementById("all_money").innerHTML);
    var payType =  'alipay';
    mark=0;
  while (localStorage.key(mark)!=null) {
        
        var temp = JSON.parse(localStorage.getItem(localStorage.key(mark)));
        temp['buy_date'] = CurentTime();
        
        temp['email'] = getCookie("email");
        
        temp['address'] = document.getElementById("address").value;

        localStorage.setItem(localStorage.key(mark),JSON.stringify(temp));

        console.log(localStorage.getItem(localStorage.key(mark)));
        
        mark = mark+1;
        
    }
    
    window.location.href = "/pay/zhifu_api_demo_json.php?amount=" + amount+"&payType=" + payType;
    
    
  
}



$(document).ready(function(){
        
        money =0;
        mark = 0;
        while (localStorage.key(mark)!=null) {
            arr = JSON.parse(localStorage.getItem(localStorage.key(mark)));
            mark  = mark+1;
            pic = arr["pic"].split(",");
            document.getElementById("carts").innerHTML=document.getElementById("carts").innerHTML+`             <tr>
            <th scope="row" class="border-0">
              <div class="p-2">
                <img src="${pic[0]}" alt="" width="70" class="img-fluid rounded shadow-sm">
                <div class="ml-3 d-inline-block align-middle">
                  <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">${arr["name"]}</a></h5><span class="text-muted font-weight-normal font-italic d-block">商品类别:电子产品</span>
                </div>
              </div>
            </th>
            <td class="border-0 align-middle"><strong>${arr["price"]}</strong></td>
            <td class="border-0 align-middle"><strong>${arr["buy_num"]}</strong></td>
            <td class="border-0 align-middle"><a href="#" class="text-dark" onclick="delete_p('${arr["id"]}')"><i class="fa fa-trash"></i></a></td>
          </tr>`;
          console.log(arr["price"]);
          money = money+(parseFloat(arr["price"])*parseFloat(arr["buy_num"]));
          
        }
        document.getElementById("money").innerHTML="$"+money;
        document.getElementById("all_money").innerHTML=money;



        

})