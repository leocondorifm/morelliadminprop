function getData(){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/publication/data/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {

        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getpublish").append('<tr>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+respObj.data[i].address+' '+respObj.data[i].number+'</td>'+
                                            '<td>'+
                                              '<button class="btn btn-icon btn-transparent-dark" onclick="getPublishByID('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#ModalPropertyEdit" data-bs-toggle="modal">'+
                                                  '<i class="fas fa-edit"></i>'+
                                              '</button>'+
                                            '</td>'+
                                        '</tr>');
            }

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}

function getPublishByID(idpub){
  

  const requestOptions = {
    method: "GET",
    redirect: "follow"
  };
  
  fetch($("#url_base").val()+"api/publication/edit/"+$("#fk_exp_u").val()+"/"+idpub, requestOptions)
  .then( resp => resp.json() )
  .then( respObj => {

    if(respObj.status == 0){
      
      let count = respObj.data.length;
      $("#description").val(respObj.data.description);
      $("#address").val(respObj.data.address);
      $("#numcalle").val(respObj.data.number);
      $("#street_one").val(respObj.data.street_one);
      $("#street_two").val(respObj.data.street_two);

    }else{
        console.log("No hay nada que mostrar: " + respObj.message);
    }
  })
    .catch((error) => console.error(error)); 
}