//Validar email
function validarEmail(email) {
    // Expresión regular para validar un correo electrónico
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

//Traigo las propiedades si tiene planificación de archivos adjuntos
function setGetPropertySend(){
    
    $("#documentsadd").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/send/property/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#documentsadd").append('<option>No hay planificación</option>');
            }else{
                $("#documentsadd").append('<option>Seleccionar planificación para la propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#documentsadd").append('<option value="'+respObj.data[i].fk_exp_building+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function getListDist(){
    console.log('Propiedad elegida: ' + $("#documentsadd").val());

    $("#newsletteradd").empty();
    $("#dataRemitente").empty();
    $("#countSuccess").html('<i class="fas fa-check-square"></i> Cantidad correctos: 0');
    $("#countDanger").html('<i class="fas fa-exclamation-triangle"></i> Cantidad incorrectos: 0');

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/send/property/newsletter/"+$("#documentsadd").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#newsletteradd").append('<option>No hay newsletter</option>');
            }else{
                $("#newsletteradd").append('<option>Seleccionar newsletter</option>');
                for(let i=0; i<count; i++){
                    $("#newsletteradd").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].description+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));

}

//Traigo los email de van a ser remitentes para revisarlos y verificar que estén correctos.
function getNewsletter(){
    let id_prop = $("#documentsadd").val();
    let id_news = $("#newsletteradd").val();
    let id_user = $("#fk_exp_u").val();
    
    $("#dataRemitente").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/send/property/remitentes/"+id_news+"/"+id_prop+"/"+id_user, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){

            let count = respObj.data.length;

            if(count===0){
                //...vacío...
            }else{
                let remitente = respObj.data[0].body_mail;
                const rem = remitente.split(";");
                var error = 0;
                var ok = 0;

                for(let i=0; i<rem.length; i++){
                    if(validarEmail(rem[i])){
                        var action = 'success';
                        var label = 'Correcto';
                        ok++;
                    }else{
                        var action = 'danger';
                        var label = 'Incorrecto';
                        error++;
                    }
                    $("#dataRemitente").append('<tr>'+
                                                    '<td>'+rem[i]+'</td>'+
                                                    '<td><span class="badge text-bg-'+action+'">'+label+'</span></td>'+
                                                '</tr>');
                    
                    //<option value="'+respObj.data[i].id+'">'+respObj.data[i].description+'</option>');
                }
                $("#countSuccess").html('<i class="fas fa-check-square"></i> Cantidad correctos: ' + ok);
                $("#countDanger").html('<i class="fas fa-exclamation-triangle"></i> Cantidad incorrectos: ' + error);

                //ahora completo los archivos según los datos seteados.
                getFile();
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
    //SELECT * FROM `EXP_NEWSLETTER` WHERE fk_exp_building = '9' and id = '10' and fk_exp_admin = '2';
}

