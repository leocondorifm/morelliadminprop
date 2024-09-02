function convDateEngToSpa(data){
  // Suponiendo que has recuperado la fecha de MySQL en formato 'YYYY-MM-DD HH:MM:SS'
  const fechaInglesConHora = data; // ejemplo de fecha con hora

  // Convertir la fecha a un objeto Date en JavaScript
  const fechaConHora = new Date(fechaInglesConHora);

  // Configuración para español (es-ES) incluyendo la hora
  const opcionesConHora = {
      weekday: 'long', // día de la semana
      year: 'numeric', // año
      month: 'long', // mes
      day: 'numeric', // día
      hour: 'numeric', // hora
      minute: 'numeric' // minutos
  };

  // Convertir la fecha y hora a español
  const fechaHoraEnEspanol = new Intl.DateTimeFormat('es-ES', opcionesConHora).format(fechaConHora);

  console.log(fechaHoraEnEspanol); // Resultado: "miércoles, 28 de agosto de 2024, 14:30"

  return fechaHoraEnEspanol;

}

function getData(){
    const requestOptions = {
        method: "GET",
        redirect: "follow"
      };
      
      fetch($("#url_base").val()+"api/publication/data/"+$("#fk_exp_u").val(), requestOptions)
      .then( resp => resp.json() )
      .then( respObj => {

        if(respObj.status == 0){
            let count = respObj.data.length;
            for(let i=0; i<count; i++){
                $("#getpublish").append('<tr>'+
                                            '<td>'+respObj.data[i].description+'</td>'+
                                            '<td>'+respObj.data[i].address+' '+respObj.data[i].number+'</td>'+
                                            '<td>'+
                                              '<button class="btn btn-icon btn-transparent-dark" onclick="getPublishByID('+respObj.data[i].id+')" data-view="'+respObj.data[i].id+'" data-bs-target="#ModalPropertyEdit" data-bs-toggle="modal">'+
                                                  '<i class="fas fa-edit"></i>'+
                                              '</button>'+
                                            '</td>'+
                                            '<td>'+
                                              '<button class="btn btn-icon btn-transparent-dark" onclick="getPicturesByFolder(\''+respObj.data[i].path+'\','+respObj.data[i].id+',\''+respObj.data[i].pic_primary+'\')" data-view="'+respObj.data[i].id+'" data-bs-target="#ModalImagesEdit" data-bs-toggle="modal">'+
                                                '<i class="fa-solid fa-image"></i>'+
                                              '</button>'+
                                            '</td>'+
                                        '</tr>');
            }

        }else{
            console.log("No hay nada que mostrar: " + respObj.message);
        }
      })
        .catch((error) => console.error(error));
}

function getPublishByID(idpub){
  

  const requestOptions = {
    method: "GET",
    redirect: "follow"
  };
  
  fetch($("#url_base").val()+"api/publication/edit/"+$("#fk_exp_u").val()+"/"+idpub, requestOptions)
  .then( resp => resp.json() )
  .then( respObj => {

    if(respObj.status == 0){
      
      let count = respObj.data.length;
      $("#description").val(respObj.data.description);
      $("#address").val(respObj.data.address);
      $("#numcalle").val(respObj.data.number);
      $("#street_one").val(respObj.data.street_one);
      $("#street_two").val(respObj.data.street_two);

      setTimeout(function(){
          $("#province").val(respObj.data.fk_sp_provincia).change();
          console.log(respObj.data.fk_sp_provincia);
      }, 1000);

      setTimeout(function(){
          $("#partido").val(respObj.data.fk_sp_partido).change();
      }, 2000);
      
      setTimeout(function(){
          $("#localidad").val(respObj.data.fk_sp_localidad).change();
      }, 2500);

      $("#price").val(respObj.data.price);
      $("#currency").val(respObj.data.currency);

      /*********** FECHA ***********/
        const fechaIngles = respObj.data.date_publish; // ejemplo de fecha en formato inglés
        // Convertir la fecha a un objeto Date en JavaScript (esto puede ser útil si necesitas manipularla)
        const fecha = new Date(fechaIngles);
        // Crear una cadena en el formato 'YYYY-MM-DD' que espera el input de tipo date
        const fechaParaInput = fecha.toISOString().split('T')[0]; // 'YYYY-MM-DD'
        // Setear la fecha en el input tipo date
        document.getElementById("date_publish").value = fechaParaInput;
      /*********** /FECHA ***********/

      $("#square_meter").val(respObj.data.square_meter);
      $("#count_bedrooms").val(respObj.data.count_bedrooms);
      $("#count_bathrooms").val(respObj.data.count_bathrooms);

      $("#amoblado").val(respObj.data.amoblado).change();
      $("#ascensor").val(respObj.data.ascensor).change();
      $("#terraza").val(respObj.data.terraza).change();
      $("#cocheras").val(respObj.data.cocheras).change();
      $("#laundry").val(respObj.data.laundry).change();
      $("#pileta").val(respObj.data.pileta).change();
      $("#mascota").val(respObj.data.mascota).change();
      $("#bauleras").val(respObj.data.bauleras).change();

      $("#aa").val(respObj.data.aa).change();
      $("#ap").val(respObj.data.ap).change();

      $("#barrioc").val(respObj.data.barrioc).change();
      $("#sum").val(respObj.data.sum).change();

      $("#long_description").val(respObj.data.long_description);

      $("#id_pub").val(respObj.data.id);

    }else{
        console.log("No hay nada que mostrar: " + respObj.message);
    }
  })
    .catch((error) => console.error(error)); 
}

function updatePropertyById(){

  $("#btn-updateProp").hide();

  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

  const urlencoded = new URLSearchParams();
  urlencoded.append("id_pub", $("#id_pub").val());
  urlencoded.append("fk_exp_u", $("#fk_exp_u").val());
  urlencoded.append("description", $("#description").val());
  urlencoded.append("long_description", $("#long_description").val());
  urlencoded.append("address",$("#address").val());
  urlencoded.append("numcalle", $("#numcalle").val());
  urlencoded.append("street_one", $("#street_one").val());
  urlencoded.append("street_two", $("#street_two").val());
  urlencoded.append("province", $("#province").val());
  urlencoded.append("partido", $("#partido").val());
  urlencoded.append("localidad", $("#localidad").val());
  urlencoded.append("price", $("#price").val());
  urlencoded.append("currency", $("#currency").val());
  urlencoded.append("date_publish", $("#date_publish").val());
  urlencoded.append("square_meter", $("#square_meter").val());
  urlencoded.append("count_bedrooms", $("#count_bedrooms").val());
  urlencoded.append("count_bathrooms", $("#count_bathrooms").val());
  urlencoded.append("amoblado", $("#amoblado").val());
  urlencoded.append("ascensor", $("#ascensor").val());
  urlencoded.append("terraza", $("#terraza").val());
  urlencoded.append("cocheras", $("#cocheras").val());
  urlencoded.append("laundry", $("#laundry").val());
  urlencoded.append("pileta", $("#pileta").val());
  urlencoded.append("mascota", $("#mascota").val());
  urlencoded.append("bauleras", $("#bauleras").val());
  urlencoded.append("aa", $("#aa").val());
  urlencoded.append("ap", $("#ap").val());
  urlencoded.append("barrioc", $("#barrioc").val());
  urlencoded.append("sum", $("#sum").val());

  const requestOptions = {
    method: "PUT",
    headers: myHeaders,
    body: urlencoded,
    redirect: "follow"
  };

  fetch($("#url_base").val()+"api/publication/update", requestOptions)
    .then( resp => resp.json())
    .then( respObj => {
      
      if(respObj.status == 0){
        $("#save-upDatePublish").html('<div class="alert alert-success" role="alert">'+
                                        ' '+respObj.message+' '+
                                      '</div>');

        setTimeout(function(){
                $("#close-mod-updatePro").trigger('click');
                location.href = 'getpublish';
        }, 2000);

      }else{
        $("#save-upDatePublish").html('<div class="alert alert-danger" role="alert">'+
          ' '+respObj.message+' '+
        '</div>');
        $("#btn-updateProp").show();
      }

    })
    .catch((error) => {
      console.error(error);
      $("#btn-updateProp").show();
    });
}

function getPicturesByFolder(folder,idpub,pic_primary){
  
  //console.log(folder);

  const requestOptions = {
    method: "GET",
    redirect: "follow"
  };
  let checked = null;

  fetch($("#url_base").val()+"api/publication/scan/"+folder, requestOptions)
    .then(resp => resp.json())
    .then(respObj => {
      //console.log(respObj);
      let count = respObj.data.length;
      for(let i=0; i<count; i++){

        if(pic_primary===respObj.data[i]){checked = "checked"; }else{checked = "";}

        //console.log(respObj.data[i]);
        $("#form-img").append('<div class="text-center form-check">' +
                                '<img src="'+$("#url_base").val()+'api/publication/public/'+folder+'/'+respObj.data[i]+'" class="rounded" style="width:200px; margin-top:5px" alt="'+respObj.data[i]+'">'+
                                '<input class="form-check-input" type="radio" name="flexRadioDefault" id="'+respObj.data[i]+'" idpub="'+idpub+'" '+checked+'>'+
                              '</div>')
      }

    })
    .catch((error) => console.error(error));

}

function setPicture(){
  //console.log('Set pictures...');
  //console.log($('input[name=flexRadioDefault]:checked','#form-img').val());
  //console.log($('input[name=flexRadioDefault]:checked','#form-img').attr('id'));
  //console.log('idpub: '+$('input[name=flexRadioDefault]:checked','#form-img').attr('idpub'));

  const myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
  
  const urlencoded = new URLSearchParams();
  urlencoded.append("id_pub", $('input[name=flexRadioDefault]:checked','#form-img').attr('idpub'));
  urlencoded.append("fk_exp_u", $("#fk_exp_u").val());
  urlencoded.append("pic_primary", $('input[name=flexRadioDefault]:checked','#form-img').attr('id'));
  
  const requestOptions = {
    method: "PUT",
    headers: myHeaders,
    body: urlencoded,
    redirect: "follow"
  };
  
  fetch($("#url_base").val()+"api/publication/update/picture", requestOptions)
    .then(resp => resp.json())
    .then(respObj => {

          if(respObj.status == 0){
            $("#save-upDatePublishImg").html('<div class="alert alert-success" role="alert">'+
              ' '+respObj.message+' '+
            '</div>');

            setTimeout(function(){
              $("#btn-updateProp").trigger('click');
              location.href = 'getpublish';
            }, 2000);

          }else{
            $("#save-upDatePublishImg").html('<div class="alert alert-error" role="alert">'+
              ' '+respObj.message+' '+
            '</div>');
          }

    })
    .catch((error) => console.error(error));


}