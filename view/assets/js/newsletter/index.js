function setGetBuild(){
    
    $("#typepropertynews").empty();

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
                $("#typepropertynews").append('<option>No hay propiedades disponibles</option>');
            }else{
                $("#typepropertynews").append('<option>Seleccionar una propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#typepropertynews").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function setPostNewsletter(){
    const formdata = new FormData();

    formdata.append("description", $("#subject").val());
    formdata.append("fk_exp_building", $("#typepropertynews").val());
    formdata.append("body_mail", $("#body_mail").val());
    formdata.append("email", $("#emails").val());

    formdata.append("fk_exp_u", $("#fk_exp_u").val());

    const requestOptions = {
        method: "POST",
        body: formdata,
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/newsletter/", requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
  
          if(respObj.status == 0){
            //console.log(respObj.message);
            $(".text-end").hide();
            $(".save-news").html('<div class="alert alert-success" role="alert">'+respObj.message+'</div>');
            setTimeout(function(){
                location.href = 'newsletter';
            }, 2000);


          }else{
            $(".sabe-news").html('<div class="alert alert-danger" role="alert">'+respObj.message+'</div>');
        /*
            $("#section-prop").addClass('alert alert-danger');
            $("#section-prop").html(respObj.message);
            $("#section-prop").show();
        */
          }
    })
    .catch((error) => console.error(error));
}