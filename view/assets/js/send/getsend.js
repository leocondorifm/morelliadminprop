function getData(){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/send/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {

        //console.log(respObj);

        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getsend").append('<tr>'+
                                            '<td>'+respObj.data[i].short_name+'</td>'+
                                            '<td>'+respObj.data[i].newsletter+'</td>'+
                                            '<td>'+respObj.data[i].filename+'</td>'+
                                            '<td>'+respObj.data[i].date+'</td>'+                         
                                        '</tr>');
            }

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}