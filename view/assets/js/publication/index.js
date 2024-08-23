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
    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    formdata.append("description", $("#description").val());
    formdata.append("long_description", $("#long_description").val());
    formdata.append("address", $("#address").val());
    formdata.append("numcalle", $("#numcalle").val());
    formdata.append("street_one", $("#street_one").val());
    formdata.append("street_two", $("#street_two").val());
    formdata.append("province", $("#province").val());
    formdata.append("partido", $("#partido").val());
    formdata.append("localidad", $("#localidad").val());
    formdata.append("price", $("#price").val());
    formdata.append("currency", $("#currency").val());
    formdata.append("date_publish", $("#date_publish").val());
    formdata.append("square_meter", $("#square_meter").val());

    formdata.append("count_bedrooms", $("#count_bedrooms").val());
    formdata.append("count_bathrooms", $("#count_bathrooms").val());
    
    formdata.append("amoblado", $("#amoblado").val());
    formdata.append("ascensor", $("#ascensor").val());
    formdata.append("terraza", $("#terraza").val());
    formdata.append("cocheras", $("#cocheras").val());
    formdata.append("laundry", $("#laundry").val());
    formdata.append("pileta", $("#pileta").val());
    formdata.append("mascota", $("#mascota").val());
    formdata.append("bauleras", $("#bauleras").val());
    formdata.append("aa", $("#aa").val());
    formdata.append("ap", $("#ap").val());
    formdata.append("barrioc", $("#barrioc").val());
    formdata.append("sum", $("#sum").val());
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