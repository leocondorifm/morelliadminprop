//console.log('getdocuments...');

function getData(){

    let filter = $("#id_build").val();//"all" or ID
    
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/file/"+$("#fk_exp_u").val()+"/"+filter, requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {

        console.log(respObj);

        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getdocuments").append('<tr>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+respObj.data[i].propiedadname+'</td>'+
                                            '<td>'+respObj.data[i].newsname+'</td>'+
                                            '<td>'+respObj.data[i].month+'</td>'+
                                            '<td>'+respObj.data[i].year+'</td>'+
                                            '<td>'+
                                                '<button class="btn btn-icon btn-transparent-dark" onclick="getDataById('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#exampleModalFullscreen" data-bs-toggle="modal">'+
                                                    '<i class="fas fa-edit"></i>'+
                                                '</button>'+
                                            '</td>'+                            
                                        '</tr>');
            }
/*
                                                '<button class="btn btn-icon btn-transparent-dark" onclick="delDataById('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#exampleModal" data-bs-toggle="modal">'+
                                                    '<i class="fas fa-trash"></i>'+
                                                '</button>'+
*/

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}

function getDataById(id){
    //console.log('getdocuments by ID...' + id);

    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
    fetch($("#url_base").val()+"api/file/edit/"+$("#fk_exp_u").val()+"/"+id, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        console.log(respObj);
        if(respObj.status == 0){
 
            $("#id_doc").val(respObj.data.id);

            $("#namefiles").val(respObj.data.description);
            $("#propertyfile").val(respObj.data.fk_exp_building).change();
            $("#newsletterplain").val(respObj.data.fk_exp_newsletter).change();
            
            $("#month").val(respObj.data.month).change();
            $("#year").val(respObj.data.year).change();
            
            //console.log(respObj.message);

            getFileByID(respObj.data.patch_file);

        }else{
            //console.log(respObj.message);
        }
    })
    .catch((error) => console.error(error));

}

function putData(){

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    
    const urlencoded = new URLSearchParams();
    urlencoded.append("id", $("#id_doc").val());
    urlencoded.append("fk_exp_u", $("#fk_exp_u").val());

    urlencoded.append("description", $("#namefiles").val());
    urlencoded.append("fk_exp_building", $("#propertyfile").val());
    urlencoded.append("fk_exp_newsletter", $("#newsletterplain").val());
    urlencoded.append("month", $("#month").val());
    urlencoded.append("year", $("#year").val());
    
    const requestOptions = {
      method: "PUT",
      headers: myHeaders,
      body: urlencoded,
      redirect: "follow"
    };
    fetch($("#url_base").val()+"api/file/update", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        //console.log(respObj);
        if(respObj.status == 0){
            $(".file-save").html('<div class="alert alert-success" role="alert">'+ respObj.message + '</div>');

            window.setInterval(function(){
                    location.href = 'getdocuments';
            },3000);
        }else{
            $(".file-save").append('<div class="alert alert-warning" role="alert">'+ respObj.message + '</div>');
            //console.log(respObj.message);
        }
    })
    .catch((error) => {
        $(".file-save").append('<div class="alert alert-danger" role="alert">'+ respObj.message + '</div>');
        //console.error(error)
    });

}

function delDataById(id){
    //console.log('Borrando=> '+id);
    $("#id-del").val(id);  
}

function delData(){
    //console.log('voy a borrar=>' + $("#id-del").val());

    const requestOptions = {
        method: "DELETE",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/newsletter/"+$("#id-del").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
          //console.log(respObj);
          if(respObj.status == 0){
            $(".confirm-del").html('<div class="alert alert-success" role="alert">'+ respObj.message + '</div>');

            window.setInterval(function(){
                    location.href = 'getdocuments';
            },3000);
        }else{
            $(".confirm-del").append('<div class="alert alert-warning" role="alert">'+ respObj.message + '</div>');
            //console.log(respObj.message);
        }
    })
    .catch((error) => {
        $(".confirm-del").append('<div class="alert alert-danger" role="alert">'+ respObj.message + '</div>');
        //console.error(error)
    });


}

function getFileByID(folder){
    
    $("#detalle-pagos").empty();

    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/file/scan/"+folder, requestOptions)
        .then(resp => resp.json())
        .then(respObj => {
 
            if(respObj.status == 0){
                let count = respObj.data.length;
                for(let i=0; i<count; i++){
                    //console.log('=====> '+respObj.data[i]);
                    $("#detalle-pagos").append('<li class="list-group-item"><a href="'+$("#url_base").val()+'api/file/uploads/'+folder+'/'+respObj.data[i]+'" target="_blank">'+respObj.data[i]+'</a></li>');
                }
            }else{
                console.log('error!');
            }
        })
        .catch((error) => console.error(error));
}