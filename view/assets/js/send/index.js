function setGetPropertySend(){
    
    $("#documentsadd").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/send/property/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#documentsadd").append('<option>No hay planificación</option>');
            }else{
                $("#documentsadd").append('<option>Seleccionar planificación para la propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#documentsadd").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}