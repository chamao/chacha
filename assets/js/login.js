function setCookie(cname,cvalue,exdays)
{
  var d = new Date();
  d.setTime(d.getTime()+(exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}

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


function jump(){
        window.location.href='/';
  }

function submit_from(){
    console.log("提交数据");
    return false;
}

$(document).ready(function(){

    $("#login").click(function(){
    var emails = document.getElementById("text_email").value;
    var passwords = document.getElementById("text_password").value;
    if (emails.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1){
            $.post("/php/login.php",
            {
                email:emails,
                password:passwords
            },
            function(data,status){
                if (data.search("登录成功") != -1) {
                    show_message(data+',正在跳转至商品页....');

                    setCookie("email",emails,1);
                    setCookie("password",hex_md5(passwords),1);

                    setTimeout(jump,2500);

                } else {
                    show_message("邮箱或密码错误，请重新输入！");
                }
            });
        
    }
    else{
        show_message("登录失败！邮箱格式错误");
        return 0;
    }


    
});
    

});


function show_message(message) {
    var t = document.getElementById('message_div');//选取id为test的div元素
    var s = document.getElementById('message_login');
    s.innerHTML=message
    t.style.display = 'block';// 以块级样式显示
}