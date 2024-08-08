console.log("...");

function getNewsletter(){
    const requestOptions = {
        method: "POST",
        redirect: "follow"
      };

      fetch($("#url_base").val()+"api/newsletter/plain/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getnewsletter").append('<tr><td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+
                                                '<button class="btn btn-icon btn-transparent-dark" onclick="getNewsletterbyID('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#exampleModalFullscreen" data-bs-toggle="modal">'+
                                                    '<i class="fas fa-edit"></i>'+
                                                '</button>'+
                                            '</td>'+                            
                                        '</tr>');
            }
        }else{
            console.log(respObj.message);
        }
      })
        .catch((error) => console.error(error));
}

function getNewsletterbyID(id){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
    };

    fetch($("#url_base").val()+"api/newsletter/edit/"+$("#fk_exp_u").val()+"/"+id, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $("#subject").val(respObj.data.description);
            console.log("=====> "+respObj.data.fk_exp_building);
            $("#typepropertynews").val(respObj.data.fk_exp_building).change()

            $("#body_mail").val(respObj.data.body_mail);
            $("#emails").val(respObj.data.email);

            $("#id_newsletter").val(respObj.data.id);

        }else{
            console.log(respObj.message);
        }

    })
    .catch((error) => console.error(error));
}

function putNewsletter(){

    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    
    const urlencoded = new URLSearchParams();
    urlencoded.append("id", $("#id_newsletter").val());
    urlencoded.append("fk_exp_u", $("#fk_exp_u").val());

    urlencoded.append("description", $("#subject").val());
    urlencoded.append("fk_exp_building", $("#typepropertynews").val());
    urlencoded.append("body_mail", $("#body_mail").val());
    urlencoded.append("email", $("#emails").val());
    
    const requestOptions = {
      method: "PUT",
      headers: myHeaders,
      body: urlencoded,
      redirect: "follow"
    };
    fetch($("#url_base").val()+"api/newsletter/update", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        
        if(respObj.status == 0){
            $(".response").html('<div class="alert alert-success" role="alert">'+ respObj.message + '</div>');

            window.setInterval(function(){
                    location.href = 'getnewsletter';
            },3000);
        }else{
            $(".response").append('<div class="alert alert-warning" role="alert">'+ respObj.message + '</div>');
            console.log(respObj.message);
        }

    })
    .catch((error) => {
        $(".response").append('<div class="alert alert-danger" role="alert">'+ respObj.message + '</div>');
        console.error(error)
    });

}