console.log('...get...data...');

function getProperty(){

    const requestOptions = {
        method: "GET",
        redirect: "follow"
    };

    fetch($("#url_base").val()+"api/property/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
                
                for(let i=0; i<count; i++){
                    $("#getproperty").append('<tr><td>'+respObj.data[i].short_name+'</td><td>'+respObj.data[i].address+' '+respObj.data[i].number+'</td>'+
                                                '<td>'+
                                                    '<button class="btn btn-icon btn-transparent-dark" data-bs-target="#exampleModalFullscreen" data-bs-toggle="modal">'+
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