function getData(){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/pay/data/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {

        //console.log(respObj);

        if(respObj.status == 0){
            let count = respObj.data.length;
            var txt = "";
            for(let i=0; i<count; i++){

                var tipo = respObj.data[i].pay_method;
                
                if(tipo==0){
                    txt = "Pagó de menos";
                }else if(tipo==100){
                    txt = "Pagó total";
                }else if(tipo==200){
                    txt = "Pagó de más";
                }else{
                    txt = "Sin datos"
                }

                $("#getpayings").append('<tr>'+
                                            '<td>'+respObj.data[i].short_name+'</td>'+
                                            '<td>'+respObj.data[i].num_floor+'</td>'+
                                            '<td>'+respObj.data[i].num_dep+'</td>'+
                                            '<td>'+respObj.data[i].ufun+'</td>'+
                                            '<td>'+respObj.data[i].last_modify+'</td>'+
                                            '<td>'+txt+'</td>'+
                                            '<td><button type="button" class="btn btn-primary" data-bs-target="#viewDetallesDePagos" data-bs-toggle="modal"><i class="fas fa-eye"></i></button></td>'+
                                        '</tr>');
            }

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}