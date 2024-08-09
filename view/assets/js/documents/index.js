function setGetBuild(){
    
    $("#propertyfile").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/newsletter/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#propertyfile").append('<option>No hay propiedades disponibles</option>');
            }else{
                $("#propertyfile").append('<option>Seleccionar una propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#propertyfile").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function setGetPlain(){
    
    $("#newsletterplain").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "POST",
    headers: myHeaders,
    redirect: "follow"
    };
                                
    fetch($("#url_base").val()+"api/newsletter/plain/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {

        console.log("Newsletter plain ===> "+respObj);
        
        if(respObj.status == 0){
            console.log(respObj.status);

            let count = respObj.data.length;
            console.log(count);
            if(count===0){
                $("#newsletterplain").append('<option>No hay planes disponibles</option>');
            }else{
                $("#newsletterplain").append('<option>Seleccionar un plan de notificación</option>');
                for(let i=0; i<count; i++){
                    $("#newsletterplain").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].description+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function postFileData(){

    let file = $('#file')[0].files[0];
    
    const myHeaders = new Headers();
    
    //console.log(file);

    const formdata = new FormData();
    formdata.append("file", file);
    formdata.append("description", $("#namefiles").val());
    formdata.append("fk_exp_building", $("#propertyfile").val());
    formdata.append("fk_exp_newsletter", $("#newsletterplain").val());
    formdata.append("month", $("#month").val());
    formdata.append("year", $("#year").val());
    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/file/upload", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $(".file-save-alert").html('');

            $(".file-save-alert").html('<div class="alert alert-success" role="alert">'+
                                            ' '+respObj.message+''+
                                        '</div>');

            setTimeout(function(){
                location.href = 'documents';
            }, 2000);

        }else{
            $(".file-save-alert").append('<div class="alert alert-success" role="alert">'+
                ' '+respObj.message+''+
            '</div>');
        }
    })
    .catch((error) => console.error(error));

}

function getFile(){
    //SELECT * FROM `EXP_FILES` WHERE fk_exp_building = '9' and fk_exp_newsletter = '15' and fk_exp_admin = '2';
    //console.log("limpio sección archivos...");
    $("#filedata").empty();
    $("#filestorage").empty();
    
    let idp = $("#documentsadd").val();
    let idn = $("#newsletteradd").val();
    
    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/send/data/"+idp+"/"+idn+"/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            //console.log(respObj.query);
            if(count===0){
                $("#filedata").append('<option>No hay colección de archivo</option>');
            }else{
                $("#filedata").append('<option>Seleccionar una colección de archivo</option>');
                for(let i=0; i<count; i++){
                    $("#filedata").append('<option class="datafile" value="'+respObj.data[i].id+'" base="'+respObj.data[i].patch_file+'">'+respObj.data[i].description+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));

}

function getAllFile(){
    //console.log('http://localhost/morelliadminprop/api/file/scan/{label}');
    
    $("#filestorage").empty();

    let label = $("#filedata>option:selected").attr("base");
    //console.log($("#filedata>option:selected").attr("base"));

    const myHeaders = new Headers();
    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/file/scan/"+label, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            //console.log(count);
            if(count===0){
                $("#filestorage").append('<tr>'+
                                            '<th scope="row">0</th>'+
                                            '<td><i>Sin datos</i></td>'+
                                            '<td><i>Sin datos</i></td>'+
                                            '<td><i>Sin datos</i></td>'+
                                        '</tr>');
            }else{
                for(let i=0; i<count; i++){
                    
                    var name = respObj.data[i].split('.')[0];
                    var type = respObj.data[i].split(".");
                    $("#filestorage").append('<tr>'+
                                                '<th scope="row">'+i+'</th>'+
                                                '<td><i>'+name+'</i></td>'+
                                                '<td><i>'+type[1]+'</i></td>'+
                                                '<td><i>'+respObj.data[i]+'</i></td>'+
                                                '<td class="text-center">'+
                                                    '<a href="http://localhost/morelliadminprop/api/file/uploads/'+label+'/'+respObj.data[i]+'" target="_blank">'+
                                                        '<i class="fas fa-download"></i>'+
                                                    '</a>'+
                                                '</td>'+
                                            '</tr>');
                    
                    $("#file-email").append('<p><a href="http://localhost/morelliadminprop/api/file/uploads/'+label+'/'+respObj.data[i]+'" target="_blank">'+respObj.data[i]+'</a></p>');

                }
            } 
        }else{

        }
    })
    .catch((error) => {
        $("#filestorage").append('<tr>'+
            '<th scope="row">0</th>'+
            '<td><i>Sin datos</i></td>'+
            '<td><i>Sin datos</i></td>'+
            '<td><i>Sin datos</i></td>'+
            '<td class="text-center"><i class="fas fa-times"></i></td>'+
        '</tr>'); 
        console.error(error)
    });

}

function stepActive(d,h){
    //console.log('stepActive');
}

function stepValidation(d,h){
    if(h===2){
       let sel = $("#documentsadd").val(); 
       if(sel=="none"){
            return true;
       }else{
            return false;
       }
    }
}