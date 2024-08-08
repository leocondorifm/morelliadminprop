
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
                                                    '<button class="btn btn-icon btn-transparent-dark" onclick="getPropertybyID('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#exampleModalFullscreen" data-bs-toggle="modal">'+
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

function getPropertybyID(data){

    const requestOptions = {
        method: "GET",
        redirect: "follow"
    };

    fetch($("#url_base").val()+"api/property/"+$("#fk_exp_u").val()+"/"+data, requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $("#shortname").val(respObj.data.short_name);

            $("#typeproperty").val(respObj.data.fk_exp_tip_pro).change();

            $("#street").val(respObj.data.address);
            $("#numberaddress").val(respObj.data.number);
            $("#cpaddress").val(respObj.data.cp);
            
            setTimeout(function(){
                $("#province").val(respObj.data.fk_sp_provincias).change();
            }, 1000);

            setTimeout(function(){
                $("#partido").val(respObj.data.fk_sp_partidos).change();
            }, 1500);

            setTimeout(function(){
                $("#localidad").val(respObj.data.fk_sp_localidades).change();
            }, 2000);

            $("#num_floors").val(respObj.data.num_floors);
            $("#num_dep_start").val(respObj.data.num_dep_start);
            $("#num_dep_end").val(respObj.data.num_dep_end);

            $("#userbuild").val(respObj.data.building_user);
            $("#passbuild").val(respObj.data.building_pass);

            $("#id_property").val(respObj.data.id);

        }else{
            console.log(respObj.message);
        }

    })
    .catch((error) => console.error(error));

}

function putProperty(){
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    const urlencoded = new URLSearchParams();
    urlencoded.append("id_property", $("#id_property").val());
    urlencoded.append("fk_exp_u", $("#fk_exp_u").val());
    urlencoded.append("shortname", $("#shortname").val());
    urlencoded.append("typeproperty", $("#typeproperty").val());
    urlencoded.append("street", $("#street").val());
    urlencoded.append("numberaddress", $("#numberaddress").val());
    urlencoded.append("cpaddress", $("#cpaddress").val());
    urlencoded.append("province", $("#province").val());
    urlencoded.append("partido", $("#partido").val());
    urlencoded.append("localidad", $("#localidad").val());
    urlencoded.append("num_floors", $("#num_floors").val());
    urlencoded.append("num_dep_start", $("#num_dep_start").val());
    urlencoded.append("num_dep_end", $("#num_dep_end").val());
    urlencoded.append("userbuild", $("#userbuild").val());
    urlencoded.append("passbuild", $("#passbuild").val());

    const requestOptions = {
    method: "PUT",
    headers: myHeaders,
    body: urlencoded,
    redirect: "follow"
    };
    fetch($("#url_base").val()+"api/property/update", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        console.log(respObj);
        console.log(respObj.status);
        if(respObj.status == 0){
            $(".response").html('<div class="alert alert-success" role="alert">'+ respObj.message + '</div>');

            window.setInterval(function(){
                    location.href = 'getproperty';
            },3000);

        }else{
            $(".response").append('<div class="alert alert-warning" role="alert">'+ respObj.message + '</div>');
        }

    })
    .catch((error) => {
        $(".response").append('<div class="alert alert-danger" role="alert">'+ respObj.message + '</div>');
        console.error(error)
    });
}