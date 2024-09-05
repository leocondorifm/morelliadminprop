function getData(){

    let filter = $("#id_build").val();//"all" or ID

    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/pay/data/"+$("#fk_exp_u").val()+"/"+filter, requestOptions)
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
                                            '<td><button type="button" onclick="setDataPopUP(\''+respObj.data[i].year+'\',\''+respObj.data[i].fk_exp_building+'\',\''+respObj.data[i].month+'\',\''+respObj.data[i].num_floor+'\',\''+respObj.data[i].num_dep+'\',\''+respObj.data[i].ufun+'\',\''+respObj.data[i].patch_file+'\',\''+respObj.data[i].short_name+'\')" class="btn btn-primary" data-bs-target="#viewDetallesDePagos" data-bs-toggle="modal"><i class="fas fa-eye"></i></button></td>'+
                                        '</tr>');
            }
            
        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}

function setDataPopUP(year,prop,month,piso,depto,uf,file,short_name){
    $("#file-pagos").empty();
    $("#address_pagos").html(short_name);
    $("#piso_pagos").html(piso);
    $("#depto_pagos").html(depto);
    $("#uf_pagos").html(uf);
    $("#file-pagos").append('<a href="'+$("#url_base").val()+'api/pay/comprobantes/propiedad/'+year+'/'+prop+'/'+month+'/'+piso+depto+'/'+file+'" target="_blank">'+file+'</a>'); 

}

function getFileByID(folder){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/file/scan/"+folder, requestOptions)
        .then(resp => resp.json())
        .then(respObj => {
 
            if(respObj.status == 0){
                let count = respObj.data.length;
                for(let i=0; i<count; i++){
                    //console.log('=====> '+respObj.data[i]);
                    $("#detalle-pagos").append('<li class="list-group-item"><a href="'+$("#url_base").val()+'api/file/uploads/'+folder+'/'+respObj.data[i]+'" target="_blank">'+respObj.data[i]+'</a></li>');
                }
            }else{
                console.log('error!');
            }
        })
        .catch((error) => console.error(error));
}