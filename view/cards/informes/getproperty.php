<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Propiedades
                            </h1>
                            <div class="page-header-subtitle">Listado completo de las propiedades habilitadas para la gestión</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Propiedades habilitadas
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="getproperty">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    <hr>
    
    </main>

    <!-- Modal EDITAR -->
    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreen" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreen">Editar propiedad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
                        <div class="mb-4">
                            <label for="shortname">Nombre corto</label>
                            <input 
                                class="form-control" 
                                id="shortname" 
                                type="text" 
                                placeholder="Ejemplo: Pampa233">
                        </div>
                        <div class="mb-4">
                            
                            <label for="newProperty">Tipo de propiedad</label>
                            <select class="form-control" id="typeproperty">
                                
                            </select>
                        </div>
                        <div class="mb-1 mb-4">
                            <label for="street">Calle</label>
                            <input 
                                class="form-control" 
                                id="street" 
                                type="text" 
                                placeholder="Ejemplo: Pampa">
                        </div>

                        <div class="mb-4 row g-2">
                            <div class="col-md">
                                <div class="row align-items-center">
                                    <label for="numberaddress" class="col-form-label">Número</label>
                                    <div class="col-auto">
                                        <input type="number" id="numberaddress" class="form-control" aria-describedby="passwordHelpInline">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md">
                                <div class="row align-items-center">
                                    <label for="cpaddress" class="col-form-label">CP</label>
                                    <div class="col-auto">
                                        <input type="number" id="cpaddress" class="form-control" aria-describedby="passwordHelpInline">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="province">Provincia</label>
                            <select class="form-control" id="province" onchange="getPartido()">
                            </select>  
                        </div>

                        <div class="mb-3">
                            <label for="partido">Partido</label>
                            <select class="form-control" id="partido" onchange="getLocalidad()">
                            </select>  
                        </div>
                        <div class="mb-3">
                            <label for="localidad">Localidad</label>
                            <select class="form-control" id="localidad">
                            </select>  
                        </div>
                        
                        <div class="mb-2">
                            <div class="mb-4 row g-3 align-items-center">
                                <div class="col-md">
                                    <label for="num_floors" class="col-form-label">Cantidad de pisos</label>
                                    <input type="number" id="num_floors" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <div class="col-md">
                                <label for="num_dep_start" class="col-form-label">Desde</label>
                                    <input type="number" id="num_dep_start" class="form-control" aria-describedby="Desde">
                                </div>

                                <div class="col-md">
                                    <label for="num_dep_end" class="col-form-label">Hasta</label>
                                    <input type="number" id="num_dep_end" class="form-control" aria-describedby="Hasta">
                                </div>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-4 row g-2" id="access_section">
                            <label for="access_section">Usuario único al sistema</label>
                            <div class="col-md">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="userbuild" placeholder="pampa233" >
                                <label for="userbuild">Usuario</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="passbuild" placeholder="Defina una contraseña">
                                <label for="passbuild">Password</label>
                                </div>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <!-- ID DE PROPIEDAD -->
                        <input type="hidden" id="id_property" />
                        
                        <div class="mb-4 space-alert response">

                            <p class="text-end">
                                <button type="button" onclick="putProperty()" class="btn btn-outline-primary"><i class="fas fa-save"></i></button>
                            </p>
                        </div>
                    </form>
            </div>
            <div class="modal-footer">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Modal BORRAR -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">¡ATENCIÓN!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro que deseas eliminar esta propiedad? Esta acción no se va a poder revertir.
            </div>
            <div id="save-updateDelete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" onclick="setDeleteProp()"><i class="fas fa-trash-alt"></i> Si, eliminarlo</button>
            </div>
            </div>
        </div>
    </div>

</div>
<script src="view/assets/js/property/getproperty.js?v=2.4"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getProvincias();
        setGetTipProp();
        getProperty();       
    });
</script>