function previewService(input){

    if($("#"+input+"").val()==""){
        console.log(input);
        return false;
    }

    if(input=="ser-url"){
        $("#"+input+"-prev").attr('src',$("#"+input+"").val());
        console.log(input);
    }else{
        $("#"+input+"-prev").html($("#"+input+"").val());
    }

}

function getService(){

    $(".allservice").empty();

    const myHeaders = new Headers();
    
    const requestOptions = {
      method: "GET",
      headers: myHeaders,
      redirect: "follow"
    };

    fetch($("#url_base").val()+"api/services/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
                
                for(let i=0; i<count; i++){
                    $(".allservice").append(
                    '<div class="col">'+
                        '<div class="card shadow-sm">'+
                            '<img src="'+respObj.data[i].url_image+'"'+
                            'class="bd-placeholder-img card-img-top" width="100%" height="200">'+
                            '<div class="card-body">'+
                                '<h5>'+respObj.data[i].title+'</h5>'+
                                '<p class="card-text">'+respObj.data[i].description+'</p>'+
                                '<small class="text-body-secondary"><i class="fas fa-phone-square-alt"></i> '+respObj.data[i].telefono+'</small> | '+
                                '<small class="text-body-secondary"><i class="fas fa-male"></i> '+respObj.data[i].contacto+'</small>'+
                            '</div>'+
                        '</div>'+
                    '</div>');
                }
 
        }else{
            console.log(respObj.message);
        }
    })
    .catch((error) => console.error(error));

}

function saveService(){

    const myHeaders = new Headers();
    const formdata = new FormData();
    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    formdata.append("ser-url", $("#ser-url").val());
    formdata.append("ser-tit", $("#ser-tit").val());
    formdata.append("ser-des", $("#ser-des").val());
    formdata.append("ser-con", $("#ser-con").val());
    formdata.append("ser-tel", $("#ser.tel").val());

    const requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: formdata,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/services/", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $("#save-service").html('');

            $("#save-service").html('<div class="alert alert-success" role="alert">'+
                                            ' '+respObj.message+''+
                                        '</div>');

            setTimeout(function(){
                location.href = 'services';
            }, 3000);

        }else{
            $("#save-service").append('<div class="alert alert-success" role="alert">'+
                ' '+respObj.message+''+
            '</div>');
        }
    })
    .catch((error) => console.error(error));
}