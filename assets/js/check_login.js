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

function setCookie(cname,cvalue,exdays)
{
  var d = new Date();
  d.setTime(d.getTime()+(exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}


function exit() {
    document.cookie = "email=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
    document.cookie = "passwords=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
    window.location.href='/';
    
}

$(document).ready(function(){


    var emails = getCookie("email");
    var passwords = getCookie("password");
    


    if (emails != "" && passwords != "") {
            $.post("/php/login_check.php",
            {
                email:emails,
                password:passwords
            },
            function(data,status){
                if (data.search("登录成功") != -1) {
                    document.getElementById("nav_login").style="display:none;";
                    document.getElementById("nav_register").style="display:none;";
                    var list=document.getElementById("nav_ul");
                    var liObj = document.createElement("li");
                    list.appendChild(liObj);
                    liObj.className="nav-item";
                    liObj.innerHTML ='<a class="nav-link text-success" href="#">' + "欢迎进入茶茶商城" + '</a>';

                    var liObj2 = document.createElement("li");
                    list.appendChild(liObj2);
                    liObj2.className="nav-item";
                    liObj2.innerHTML ='<a class="nav-link text-warning" onclick="exit()">' + "点击退出" + '</a>';
                } else {
                    return 0;
                }
            });
        
    }
    else{
        return 0;
    }


    
})

