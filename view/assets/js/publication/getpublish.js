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
                                            '<td>'+respObj.data[i].last_modify+'</td>'+
                                        '</tr>');
            }

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}