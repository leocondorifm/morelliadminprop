function login(){
    if($("#usuariologin").val()==''){
        $("#userHelp").html('');
        return false;
    }

    if($("#passlogin").val()==''){
        $("#userHelp").html('');
        return false;
    }

    const myHeaders = new Headers();
    //myHeaders.append("Cookie", "PHPSESSID=caa8b0hn4r8ms8keipo85fiai6");
    const formdata = new FormData();
    formdata.append("user", $("#usuariologin").val());
    formdata.append("pass", $("#passlogin").val());
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/user/login", requestOptions)
    .then(response => response.json())
      .then((result) => {
        if(result.status != 0){
            $("#txthelp").html(result.message);
        }else{

            var checkbox = $('#loginCheck');
            var isChecked = checkbox.prop('checked'); // Verifica si está marcado
            var value = checkbox.val(); // Obtiene el valor del checkbox
    
            if (isChecked) {
                window.localStorage.setItem('remember',true);
                window.localStorage.setItem('user',$("#usuariologin").val());
                window.localStorage.setItem('pass',$("#passlogin").val());
            } else {
                window.localStorage.setItem('remember',false);
                localStorage.removeItem("user");
                localStorage.removeItem("pass");

            }
            location.reload();
            $("#txthelp").html('');
        }
      })
      .catch((error) => console.error(error));

}

function checkUser(){

    if($("#usuariologin").val()==''){
        $("#userHelp").html('');
        return false;
    }

    const myHeaders = new Headers();   
    const requestOptions = {
      method: "GET",
      headers: myHeaders,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/user/validate/"+$("#usuariologin").val(), requestOptions)
    .then(response => response.json())
      .then((result) => {
        if(result.status != 0){
            $("#btn-in").hide();
            $("#userHelp").html(result.message);
        }else{
            $("#btn-in").show();
            $("#userHelp").html('');
        }
      })
      .catch((error) => console.error(error));
}

function showPass(){

    var elementType = $("#passlogin").prop('type');

    if(elementType==="password"){
        $("#passlogin").attr('type','text');
    }else{
        $("#passlogin").attr('type','password');
    }

}

function viewPass(id){
    var elementType = $("#pass"+id).prop('type');

    if(elementType==="password"){
        $("#pass"+id).attr('type','text');
    }else{
        $("#pass"+id).attr('type','password');
    }   
}

function resetPass(){

    if($("#emailreset").val()==''){
        $("#emailresetHelp").html('');
        return false;
    }

const myHeaders = new Headers();   
const requestOptions = {
  method: "GET",
  headers: myHeaders,
  redirect: "follow"
};

fetch($("#url_base").val()+"api/email/validate/"+$("#emailreset").val(), requestOptions)
.then(response => response.json())
  .then((result) => {
    if(result.status != 0){
        $("#getReset").hide();
        $("#emailresetHelp").html(result.message);
    }else{
        $("#getReset").show();
        $("#emailreset").prop('disabled', true);
        $("#emailresetHelp").html('');
    }
  })
  .catch((error) => console.error(error));


}

function changePass(){
    console.log($("#emailreset").val());
    $("#getReset").hide();
    $("#procesing").show();
    
    if($("#emailreset").val()==''){
        $("#emailresetHelp").html('');
        return false;
    }

    const myHeaders = new Headers();
    const formdata = new FormData();
    formdata.append("email", $("#emailreset").val());
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    fetch("https://www.leocondori.com.ar/api/service/morelli.php", requestOptions)
    .then(response => response.json())
      .then((result) => {
        
        $("#procesing").hide();

        if(result.status != 0){
            $("#emailresetHelp").html(result.message);
            $("#getReset").show();
        }else{
            $("#emailresetHelp").removeClass('custom-label-danger').addClass('custom-label-success');
            $("#emailresetHelp").html('¡Email enviado con éxito! Revisa tu email, por la dudas también revisa tu carpeta de SPAM.');

        }
      })
      .catch((error) => console.error(error));

}

function setPassword(){
    $("#infoSetPass").hide();
    let email1 = $("#pass1").val();
    let email2 = $("#pass2").val();

    if(email1!=email2){
        $("#infoSetPass").show();
        $("#infoSetPass").html('La contraseñas deben ser iguales.');
        return false;
    }


    const myHeaders = new Headers();
    const formdata = new FormData();
    formdata.append("pass1", $("#pass1").val());
    formdata.append("pass2", $("#pass2").val());
    formdata.append("uri_hash", $("#uri_hash").val());
    formdata.append("uri_mail", $("#uri_mail").val());

    const requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: formdata,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/user/setpass", requestOptions)
    .then(response => response.json())
      .then((result) => {
        $("#infoSetPass").show();
        console.log(result.status);
        console.log(result.message);
        if(result.status != 0){
            $("#updateBtn").show();
            $("#infoSetPass").html(result.messege);
        }else{
            $("#updateBtn").hide();
            $("#infoSetPass").removeClass('custom-label-danger').addClass('custom-label-success');
            $("#infoSetPass").html(result.message);
            
            $("#number").show();
            var n = 3;
            var l = document.getElementById("number");
            window.setInterval(function(){
                l.innerHTML = n;
                if(n<=0){
                    location.href = 'start';
                }
                n--;
            },1000);
        }
      })
    .catch((error) => console.error(error));
    


}