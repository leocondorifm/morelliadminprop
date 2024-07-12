function saveData(){
    const formdata = new FormData();

    formdata.append("short_name", $("#shortname").val());
    formdata.append("fk_exp_tip_pro", $("#typeproperty").val());
    formdata.append("address", $("#street").val());
    formdata.append("number", $("#numberaddress").val());
    formdata.append("cp", $("#cpaddress").val());

    formdata.append("fk_sp_provincias", $("#province").val());
    formdata.append("fk_sp_partidos", $("#partido").val());
    formdata.append("fk_sp_localidades", $("#localidad").val());

    formdata.append("building_user", $("#userbuild").val());
    formdata.append("building_pass", $("#passbuild").val());

    formdata.append("num_floors", $("#num_floors").val());
    formdata.append("num_dep_start", $("#num_dep_start").val());
    formdata.append("num_dep_end", $("#num_dep_end").val());

    formdata.append("fk_exp_u", $("#fk_exp_u").val());

    const requestOptions = {
      method: "POST",
      body: formdata,
      redirect: "follow"
    };
    
    fetch($("#url_base").val()+"api/property/", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {

        if(respObj.status == 0){
            $(".space-alert").before('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                                        '<h5 class="alert-heading">Alta de nueva Propiedad</h5>' +
                                        ' '+respObj.message+' '+
                                        '<span id="count-down"></span>'+
                                        '<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>');
                                    var n = 3;
                                    var l = document.getElementById("count-down");
                                    window.setInterval(function(){
                                        l.innerHTML = n;
                                        if(n<=0){
                                            location.href = 'property';
                                        }
                                        n--;
                                    },1000);
        }else{
            $(".space-alert").before('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                        '<h5 class="alert-heading">Alta de nueva Propiedad</h5>' +
                                            ' '+respObj.message+' '+
                                            '<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>');
        }
        
    })
    .catch((error) => console.error(error));

}

