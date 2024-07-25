function getPropertyPay(owner,id,name){

    if(owner==1){
   
        $("#payproperty").empty();
    
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
                    $("#payproperty").append('<option>No hay propiedades</option>');
                }else{
                    document.getElementById("payproperty").removeAttribute("disabled");
                    $("#payproperty").append('<option value="none">Seleccionar la propiedad</option>');
                    for(let i=0; i<count; i++){
                        $("#payproperty").append('<option value="'+respObj.data[i].fk_exp_building+'" num_floors="'+respObj.data[i].num_floors+'" address-name="'+respObj.data[i].address+'" address-number="'+respObj.data[i].number+'" address-cp="'+respObj.data[i].cp+'">'+respObj.data[i].short_name+'</option>');
                    }

                } 
            }else{
                console.log(respObj.message);
            }
        })
        .catch((error) => console.error(error));




    }else{

        $("#payproperty").append('<option value="'+id+'">'+name+'</option>');
        var floors = $("#num_floors").val();

        if(!Number.isInteger(floors)){
            var floor = parseInt(floors);
        }
        
        for(var i=0; i<=floor;i++){
            $("#floors").append('<option value="'+i+'">'+i+'</option>');
        }

    }

}

function setFloors(){
    $("#floors").empty();

    var floors = $("#payproperty>option:selected").attr("num_floors");

    if(!Number.isInteger(floors)){
        var floor = parseInt(floors);
    }
    
    for(var i=0; i<=floor;i++){
        $("#floors").append('<option value="'+i+'">'+i+'</option>');
    }
}

function savePay(){

    const myHeaders = new Headers();
    let file = $('#filepay')[0].files[0];

    const formdata = new FormData();
    formdata.append("payproperty", $("#payproperty").val());
    formdata.append("paydata", $("#paydata").val());
    formdata.append("month", $("#month").val());
    formdata.append("year", $("#year").val());
    formdata.append("floors", $("#floors").val());
    formdata.append("depto", $("#depto").val());
    formdata.append("paynote", $("#paynote").val());
    formdata.append("filepay", file);
    formdata.append("fk_exp_u", $("#fk_exp_u").val());
    
    const requestOptions = {
      method: "POST",
      headers: myHeaders,
      body: formdata,
      redirect: "follow"
    };

    fetch($("#url_base").val()+"api/pay/upload", requestOptions)
    .then( resp => resp.json() )
    .then( respObj => {
        if(respObj.status == 0){
            $("#save-pay").html('');

            $("#save-pay").html('<div class="alert alert-success" role="alert">'+
                                            ' '+respObj.message+''+
                                        '</div>');

            setTimeout(function(){
                location.href = 'payings';
            }, 3000);

        }else{
            $("#save-pay").append('<div class="alert alert-success" role="alert">'+
                ' '+respObj.message+''+
            '</div>');
        }
    })
      .catch((error) => console.error(error));


}