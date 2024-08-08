console.log('getdocuments...');

function getData(){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/file/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getdocuments").append('<tr>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>01</td>'+
                                            '<td>01</td>'+
                                            '<td>'+
                                                '<button class="btn btn-icon btn-transparent-dark" onclick="getDataById('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#exampleModalFullscreen" data-bs-toggle="modal">'+
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

function getDataById(id){
    console.log('getdocuments by ID...' + id);

    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
    fetch($("#url_base").val()+"api/file/edit/"+$("#fk_exp_u").val()+"/"+id, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        console.log(respObj);
        if(respObj.status == 0){

            $("#namefiles").val(respObj.data.description);
            $("#propertyfile").val(respObj.data.fk_exp_building).change();
            $("#month").val(respObj.data.month).change();
            $("#year").val(respObj.data.year).change();
            
            console.log(respObj.message);
        }else{
            console.log(respObj.message);
        }
    })
    .catch((error) => console.error(error));

}