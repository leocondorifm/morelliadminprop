<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Prestadores de Servicios de urgencias
                            </h1>
                            <div class="page-header-subtitle">Disponibilizamos el listado de prestadores autorizados como prestadores de urgencias</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Profesionales y empresas habilitadas
                </div>
                <div class="card-body">
                    <table id="table-urgencias" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Rubro</th>
                                <th>Descripción</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       

    </main>
</div>
<script src="view/assets/js/services/index.js?v=7.4"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {

        //const datatablesSimple = document.getElementById('datatablesSimple');
        //new simpleDatatables.DataTable(datatablesSimple);
        var tableElement = document.querySelector("#table-urgencias");
        var dataTable = new simpleDatatables.DataTable(tableElement);

        //getServicePublic(simpleDatatables);

        //$("#datatablesSimple tbody").empty();

        const myHeaders = new Headers();

        const requestOptions = {
        method: "GET",
        headers: myHeaders,
        redirect: "follow"
        };

        fetch($("#url_base").val()+"api/services/"+$("#fk_exp_u").val(), requestOptions)
        .then(response => response.json())
        .then(dato => {
            var count = dato.data.length;
            /*for(var i=0; i<count; i++){
                console.log(dato.data[i].title);
                $("#table-urgencias tbody").append('<tr><td>'+dato.data[i].title+'</td><td>'+dato.data[i].description+'</td><td>'+dato.data[i].contacto+'</td><td>'+dato.data[i].telefono+'</td></tr>');
            }*/
            $("#table-urgencias tbody").append('<tr><td>leo</td><td>Marino</td><td>Condo</td><td>Dete</td></tr>');
            dataTable.update();
            // Procesar y agregar los datos a la tabla
            /*json.data.forEach(item => {
                
                var row = '<tr>' +
                    '<td>' + item.title + '</td>' +
                    '<td>' + item.description + '</td>' +
                    '<td>' + item.contacto + '</td>' +
                    '<td>' + item.telefono + '</td>' +
                    '</tr>';
                $('#exampless tbody').append(row);
            });*/
            // Actualizar la tabla para mostrar los nuevos datos
            //dataTable.update();
        })
        .catch(error => console.error('Error al obtener los datos:', error));
        
    });
</script>