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
                                '<hr class="sidebar-divider d-none d-md-block">'+
                                '<button type="button" onclick="editService(\''+respObj.data[i].id+'\')" id="btn-'+respObj.data[i].id+'" class="btn btn-danger">Borrar</button>'+
                                '<span class="badge rounded-pill text-bg-success" style="display:none" id="success-ser-'+respObj.data[i].id+'"></span>'+
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

function editService(idd){

    const formdata = new FormData();
    
    const requestOptions = {
      method: "PUT",
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/services/"+idd+"/"+$("#fk_exp_u").val()+"", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            console.log(respObj.message);
            $("#btn-"+idd).hide();
            $("#success-ser-"+idd).show();

            $("#success-ser-"+idd).html(respObj.message);

            setTimeout(function(){
                getService();
            }, 2000);

        }else{
           console.log(respObj.message);
        }
    })
    .catch((error) => console.error(error));

}

function getServicePublic(){

    $("table tbody").empty();

    const myHeaders = new Headers();

    const requestOptions = {
      method: "GET",
      headers: myHeaders,
      redirect: "follow"
    };

    fetch($("#url_base").val()+"api/services/"+$("#fk_exp_u").val(), requestOptions)
    .then(response => response.json())
    .then(dato => {
        var count = dato.data.length;
        for(var i=0; i<count; i++){
            $("table tbody").append('<tr>'+
                                        '<td>'+dato.data[i].title+'</td>'+
                                        '<td>'+dato.data[i].description+'</td>'+
                                        '<td>'+dato.data[i].contacto+'</td>'+
                                        '<td>'+dato.data[i].telefono+'</td>'+
                                    '</tr>');
        }
    })
    .catch(error => console.error('Error al obtener los datos:', error));

}