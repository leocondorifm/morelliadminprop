function setGetBuild(){
    
    $("#propertyfile").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/newsletter/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#propertyfile").append('<option>No hay propiedades disponibles</option>');
            }else{
                $("#propertyfile").append('<option>Seleccionar una propiedad</option>');
                for(let i=0; i<count; i++){
                    $("#propertyfile").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].short_name+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function setGetPlain(){
    
    $("#newsletterplain").empty();

    const myHeaders = new Headers();

    const requestOptions = {
    method: "GET",
    headers: myHeaders,
    redirect: "follow"
    };

    fetch($("#url_base").val()+"api/newsletter/plain/"+$("#fk_exp_u").val(), requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            let count = respObj.data.length;
            if(count===0){
                $("#newsletterplain").append('<option>No hay planes disponibles</option>');
            }else{
                $("#newsletterplain").append('<option>Seleccionar un plan de notificación</option>');
                for(let i=0; i<count; i++){
                    $("#newsletterplain").append('<option value="'+respObj.data[i].id+'">'+respObj.data[i].description+'</option>');
                }
            } 
        }else{

        }
    })
    .catch((error) => console.error(error));
}

function postFileData(){

    let file = $('#file')[0].files[0];
    
    const myHeaders = new Headers();
    
    console.log(file);

    const formdata = new FormData();
    formdata.append("file", file);
    formdata.append("description", $("#namefiles").val());
    formdata.append("fk_exp_building", $("#propertyfile").val());
    formdata.append("fk_exp_newsletter", $("#newsletterplain").val());
    formdata.append("month", $("#month").val());
    formdata.append("year", $("#year").val());
    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/file/upload", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $(".file-save-alert").html('');

            $(".file-save-alert").html('<div class="alert alert-success" role="alert">'+
                                            ' '+respObj.message+''+
                                        '</div>');

            setTimeout(function(){
                location.href = 'documents';
            }, 2000);

        }else{
            $(".file-save-alert").append('<div class="alert alert-success" role="alert">'+
                ' '+respObj.message+''+
            '</div>');
        }
    })
    .catch((error) => console.error(error));

}