//0: Validar email
function validarEmail(email) {
    // Expresión regular para validar un correo electrónico
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

//1: Traigo las propiedades si tiene planificación de archivos adjuntos
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
                $("#documentsadd").append('<option value="none">Seleccionar planificación para la propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#documentsadd").append('<option value="'+respObj.data[i].fk_exp_building+'" address-name="'+respObj.data[i].address+'" address-number="'+respObj.data[i].number+'" address-cp="'+respObj.data[i].cp+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

//2: Traigo el Nesletter
function getListDist(){
    console.log('Propiedad elegida: ' + $("#documentsadd").val());
    $("#validation-step").html('');
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
                    $("#newsletteradd").append('<option value="'+respObj.data[i].id+'" body-email="'+respObj.data[i].email+'" subjet-email="'+respObj.data[i].description+'">'+respObj.data[i].description+'</option>');
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

//FIN: Armado de plantilla final
function getModelData(){

    /*::::: SUBJET :::::::*/
    let subjetemail = $("#newsletteradd>option:selected").attr("subjet-email");
    if(subjetemail===undefined){subjetemail = '';}
    $("#subjetemail").html(subjetemail);

    /*:::::: BODY EMAIL ::::::*/
    let bodyemail = $("#newsletteradd>option:selected").attr("body-email");
    if(bodyemail===undefined){bodyemail = '';}
    $("#bodyemail").html(bodyemail);

    /*:::::: FILE STORAGE ::::::file-email*/


    /*:::::: FOOTER ::::::*/
    let address = $("#documentsadd>option:selected").attr("address-name");
    let number = $("#documentsadd>option:selected").attr("address-number");
    let cp = $("#documentsadd>option:selected").attr("address-cp");
    if(address===undefined){address = '';}
    if(number===undefined){number = '';}
    if(cp===undefined){cp = '';}else{cp='('+cp+')';}
    $("#address-send").html(address + ' '+number +' ' + cp + '');
}