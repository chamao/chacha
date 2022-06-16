
function submit_from(){
    console.log("提交数据");
    return false;
}


function setCookie(cname,cvalue,exdays)
{
  var d = new Date();
  d.setTime(d.getTime()+(exdays*24*60*60*1000));
  var expires = "expires="+d.toGMTString();
  document.cookie = cname + "=" + cvalue + "; " + expires;
}


function jump(){
    window.location.href='/';
}


$(document).ready(function(){
    $("#resigin").click(function(){
    var emails = document.getElementById("text_email_register").value;
    var passwords = document.getElementById("text_password_register").value;
    var passwords_check = document.getElementById("text_password_check").value;
    if (emails.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1){
            $.post("/php/register.php",
            {
                email:emails,
                password:passwords
            },
            function(data,status){
                
                if(passwords != "" && passwords_check != ""){
                    if(passwords == passwords_check){
                                        if (data.search("注册成功") != 0) {
                    show_message("注册成功，正在跳转至商品页");
                    setCookie("email",emails,1);
                    setCookie("password",hex_md5(passwords),1);
                    setTimeout(jump,2500);
                    return 0;
                }
                if (data.search("已存在") != 0) {
                    show_message("账号已存在，请使用已注册账号登录");
                    return 0;
                }
                    }
                    else{
                        alert("两次输入的密码不一致！")
                    }
                }
                else{
                    alert("密码或重复密码为空！");
                }
                
                
                

            });
        
    }
    else{
        show_message("注册失败！邮箱格式错误");
        return 0;
    }


    
});

});


function show_message(message) {
    var t = document.getElementById('message_div');//选取id为test的div元素
    var s = document.getElementById('message_login');
    s.innerHTML=message
    t.style.display = 'block';// 以块级样式显示
    return 0;
}