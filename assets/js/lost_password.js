function send_code(){
    $.post("/php/email.php",
    {
        email:document.getElementById("email").value,
    },
    function(data,status){
        if (data.search("发送成功") != -1) {
            alert("发送成功,请输入您的验证码");
            foo(document.getElementById("send"),6000);
        }
        else{
            alert("发送失败,邮箱账号不存在");
        }






    });
}


function asd(){
    pass = document.getElementById("new_password").value ;
    pass_check = document.getElementById("new_password_check").value ;
    if(pass == "" || pass_check == ""){
        alert("密码或重复密码为空");
        return 0;
        }
    else{
        if (pass == pass_check) {
               $.post("/php/check_code.php",
    {
        email:document.getElementById("email").value,
        code:document.getElementById("email_code").value,
        new_password:document.getElementById("new_password").value
    },
    function(data,status){
        if (data.search("修改成功") != -1) {
            alert("密码修改成功，正在为您跳转至登录页....");
            window.location.href='/login.html';
        }
        else{
            alert("邮箱验证码错误!");
        }






    });
            
        }
        else{
            alert("两次输入的密码不一致！");
        }
    }

}



function foo(obj, time) {
    obj.disabled = true;

    setTimeout(function() {
        var x = setInterval(function(){
                time= time - 1000; //reduce each second
                obj.innerHTML = String((time/1000)%60);
                console.log(String((time/1000)%60));
                if(time==0){
                        clearInterval(x);
                        obj.innerHTML = "发送验证码";
                        obj.disabled = false;
                }
        }, 1000);
    }, time-10000);
}