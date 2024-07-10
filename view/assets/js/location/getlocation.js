//LLAMADO POR EL BACKEND
function getProvincias(){//OK
$("#province").append('<option value="">Seleccione una provincia...</option>');

const requestOptions = {
    method: "GET",
    redirect: "follow"
    };
    
    fetch("http://localhost/morelliadminprop/api/province", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){            
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#province").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].descripcion+'</option>');
            } 
        }else{
            console.log(respObj.message);
            return false;
        }
    })
    .catch( error => {
        console.log(error);
        return false;
    });
}

function getPartido(){
    
    let idProv= $("#province").val();
    if(idProv===""){
        $("#partido").empty();
        $("#partido").append('<option value="">Elegir una partido...</option>');
        return false;
    }
    $("#partido").empty();
    $("#partido").append('<option value="">Elegir una partido...</option>');

    const requestOptions = {
        method: "GET",
        redirect: "follow"
        };
        
        fetch("http://localhost/morelliadminprop/api/province/partido/"+idProv, requestOptions)
        .then( resp => resp.json() )
        .then( respObj => {
            if(respObj.status == 0){            
                let count = respObj.data.length;
                for(let i=0; i<count; i++){
                    $("#partido").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].descripcion+'</option>');
                } 
            }else{
                console.log(respObj.message);
                return false;
            }
        })
        .catch( error => {
            console.log(error);
            return false;
        }); 
}

function getLocalidad(){//OK 
    let idpartido=$("#partido").val();
    if(idpartido===""){
        $("#localidad").empty();
        $("#localidad").append('<option value="">Elegir una localidad...</option>');
        return false;
    }
    $("#localidad").empty();
    $("#localidad").append('<option value="">Elegir una localidad...</option>');
 
    const requestOptions = {
    method: "GET",
    redirect: "follow"
    };
    
    fetch("http://localhost/morelliadminprop/api/province/partido/localidad/"+idpartido, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){            
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#localidad").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].descripcion+'</option>');
            } 
        }else{
            console.log(respObj.message);
            return false;
        }
    })
    .catch( error => {
        console.log(error);
        return false;
    });
    
}