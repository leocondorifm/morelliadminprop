//Obtener monedas
function getCurrency(){
    
    $("#currency").empty();

    const myHeaders = new Headers();
    
    const requestOptions = {
      method: "GET",
      headers: myHeaders,
      redirect: "follow"
    };

    fetch($("#url_base").val()+"api/settings/currency/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#currency").append('<option>Seleccione moneda</option>');
            }else{
                
                $("#currency").append('<option value="none">Seleccione moneda</option>');
                for(let i=0; i<count; i++){
                    $("#currency").append('<option value="'+respObj.data[i].id+'" >'+respObj.data[i].iso+' ('+respObj.data[i].simbolo+')</option>');
                }

            } 
        }else{
            console.log(respObj.message);
        }
    })
    .catch((error) => console.error(error));


}

//Grabar nueva moneda
function saveCurrency(){

    const formdata = new FormData();

    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    formdata.append("simbolo", $("#sim-code").val());
    formdata.append("iso", $("#iso-code").val());

    const requestOptions = {
        method: "POST",
        body: formdata,
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/settings/currency", requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
          if(respObj.status == 0){
            $("#up-currency").hide();
            $("#action-save-curr").hide();

            $("#section-prop-currency").addClass('alert alert-success');
            $("#section-prop-currency").html(respObj.message);
            $("#section-prop-currency").show();

                getCurrency();
                setTimeout(function(){
                        $("#close-mod-currency").trigger('click');
                }, 2000);
          }else{
            console.log(respObj.message);
            $("#section-prop-currency").addClass('alert alert-danger');
            $("#section-prop-currency").html(respObj.message);
            $("#section-prop-currency").show();
          }
    })
    .catch((error) => console.error(error));
}

function publishNow(){

    let file = $('#filepublish')[0].files[0];

    const myHeaders = new Headers();
    
    const formdata = new FormData();
    formdata.append("fk_exp_u", "2");
    formdata.append("description", "Monoambiente - Sum Y Pileta - Belgrano - Alquiler");
    formdata.append("long_description", "Excelente Monoambiente de 30 metros, al lateral.\nMuy luminoso, con una amplia vista.\nCocina y horno eléctricos. Baño completo.\nCalefacción por aire acondicionado frío-calor.\nAgua caliente central.\nSin Muebles.\n\n\nExpensas $58.000\nABL $7.000\nEdificio de 10 pisos.\nCada piso cuenta con 3 unidades.\nSin cochera.\nApto profesional.\nAmenities: Piscina y SUM\n");
    formdata.append("address", "Primera Junta");
    formdata.append("numcalle", "9");
    formdata.append("street_one", "Laferre");
    formdata.append("street_two", "Santa fe");
    formdata.append("province", "1");
    formdata.append("partido", "1");
    formdata.append("localidad", "1");
    formdata.append("price", "10982");
    formdata.append("currency", "1");
    formdata.append("date_publish", "2024-07-25 02:54:10");
    formdata.append("count_bedrooms", "1");
    formdata.append("count_bathrooms", "1");
    formdata.append("square_meter", "54");
    formdata.append("amoblado", "Si");
    formdata.append("ascensor", "Si");
    formdata.append("terraza", "Si");
    formdata.append("cocheras", "Si");
    formdata.append("laundry", "Si");
    formdata.append("pileta", "Si");
    formdata.append("mascota", "Si");
    formdata.append("bauleras", "Si");
    formdata.append("aa", "Si");
    formdata.append("ap", "Si");
    formdata.append("barrioc", "Si");
    formdata.append("sum", "Si");
    formdata.append("filepublish", file);
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/publication/create", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {

        if(respObj.status == 0){
            $("#save-publish").html('');

            $("#save-publish").html('<div class="alert alert-success" role="alert">'+
                                            ' '+respObj.message+''+
                                        '</div>');

            setTimeout(function(){
                location.href = 'publication';
            }, 3000);

        }else{
            $("#save-publish").append('<div class="alert alert-success" role="alert">'+
                ' '+respObj.message+''+
            '</div>');
        }

    })
    .catch((error) => console.error(error));

}