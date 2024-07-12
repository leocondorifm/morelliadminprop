function setPostTipoProp(){
    const formdata = new FormData();

    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    formdata.append("description", $("#addTypeproperty").val());


    const requestOptions = {
        method: "POST",
        body: formdata,
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/settings/", requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
  
          if(respObj.status == 0){
                $("#mod-input").hide();
                $("#action-save-tip").hide();

                $("#section-prop").addClass('alert alert-success');
                $("#section-prop").html(respObj.message);
                $("#section-prop").show();

                setGetTipProp();

                setTimeout(function(){
                        $("#close-mod-prop").trigger('click');
                }, 2000);

          }else{
            $("#section-prop").addClass('alert alert-danger');
            $("#section-prop").html(respObj.message);
            $("#section-prop").show();
          }
    })
    .catch((error) => console.error(error));
}

function setGetTipProp(){
    
    $("#typeproperty").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/settings/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#typeproperty").append('<option>No hay tipo de propiedades disponibles</option>');
            }else{
                $("#typeproperty").append('<option>Seleccionar tipo de propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#typeproperty").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].description+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}