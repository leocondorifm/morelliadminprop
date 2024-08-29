<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Propiedad
                            </h1>
                            <div class="page-header-subtitle">Listado completo de propiedades</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Pagos informados
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Propiedad</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="getpublish">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    <hr>
    
    </main>

    <div class="modal fade" id="ModalPropertyEdit" tabindex="-1" aria-labelledby="ModalPropertyEdit" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreen">Editar propiedad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form>
                    <div class="mb-4">
                        <label for="description">Título</label>
                        <input 
                            class="form-control" 
                            id="description" 
                            type="text" 
                            placeholder="Alquiler Amoblado Colegiales 2 Amb">
                    </div>

                    <div class="row gx-4 mb-4">
                        
                        <div class="col-md-8 mb-md-0">
                            <label class="small mb-1" for="address">Dirección</label>
                            <input class="form-control" id="address" type="text" placeholder="Azamor" />
                        </div>
                        <div class="col-md-4">
                            <label class="small mb-1" for="numcalle">Número</label>
                            <input class="form-control" id="numcalle" type="text" value="2042" />
                        </div>
                    </div>

                    <div class="row gx-4 mb-4">
                        <label for="inputPhone">Entre calles:</label>
                        <div class="col-md-6 mb-md-0">
                            <label class="small mb-1" for="street_one">Calle 1</label>
                            <input class="form-control" id="street_one" type="text" placeholder="Calle 1" />
                        </div>
                        <div class="col-md-6 mb-md-0">
                            <label class="small mb-1" for="street_two">Calle 2</label>
                            <input class="form-control" id="street_two" type="text" placeholder="Calle 2" />
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
                    <div class="mb-4">
                        <label for="localidad">Localidad</label>
                        <select class="form-control" id="localidad">
                        </select>  
                    </div>
                    
                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row gx-3 md-4 mb-4">
                        <div class="col-md-4 mb-md-0">
                            <label class="small mb-1" for="price">Precio</label>
                            <input class="form-control" id="price" type="number" placeholder="Ingrese el precio" />
                        </div>
                        <div class="col-md-4 mb-md-0">
                            <label class="small mb-1" for="currency">
                               Moneda
                            </label>
                            <select class="form-control" id="currency">
                            </select>
                        </div>
                        <div class="col-md-4 mb-0">
                            <label class="small mb-1" for="date_publish">Fecha de publicación</label>
                            <input class="form-control" id="date_publish" type="date" name="date_publish" />
                        </div>
                    </div>

                    <div class="row gx-3 md-4 mb-4">
                        <div class="col-md-4 mb-md-0">
                            <label class="small mb-1" for="square_meter">Metros</label>
                            <input class="form-control" id="square_meter" type="number" placeholder="Metros 2" />
                        </div>
                        <div class="col-md-4 mb-md-0">
                            <label for="typeproperty">
                                Dormitorios
                            </label>
                            <input class="form-control" id="count_bedrooms" type="number" placeholder="Cant. dormitorios"/>
                        </div>
                        <div class="col-md-4 mb-md-0">
                            <label for="typeproperty">
                                Baños
                            </label>
                            <input class="form-control" id="count_bathrooms" type="number" placeholder="Cant. de baños"/>
                        </div>
                    </div>

                    <hr class="sidebar-divider d-none d-md-block">

                    <div class="row gx-3 md-4 mb-4">
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Amoblado</label>
                            <select class="form-control" id="amoblado">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Ascensor</label>
                            <select class="form-control" id="ascensor">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Terraza</label>
                            <select class="form-control" id="terraza">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Cocheras</label>
                            <select class="form-control" id="cocheras">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Laundry</label>
                            <select class="form-control" id="laundry">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty">Pileta</label>
                            <select class="form-control" id="pileta">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row gx-3 md-4 mb-4">
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">Admite mascotas: </label>
                            <select class="form-control" id="mascota">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">Bauleras</label>
                            <select class="form-control" id="bauleras">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">Aire acond.</label>
                            <select class="form-control" id="aa">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">Apto profesional</label>
                            <select class="form-control" id="ap">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">Barrio cerrado</label>
                            <select class="form-control" id="barrioc">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-md-0">
                            <label for="typeproperty" style="font-size:12px">SUM</label>
                            <select class="form-control" id="sum">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <hr class="sidebar-divider d-none d-md-block">
                            
                    <div class="mb-4">
                        <label for="long_description">Descripción</label>
                        <textarea class="form-control" id="long_description" rows="3"></textarea>
                    </div>

                    <hr class="sidebar-divider d-none d-md-block">
                    <input type="hidden" id="id_pub">
                    <section id="save-upDatePublish"></section>
                    
                    <div class="mb-4">
                        <p class="text-end">
                            <button type="button" onclick="updatePropertyById()" class="btn btn-outline-primary" id="btn-updateProp"><i class="fas fa-save"></i></button>
                        </p>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close-mod-updatePro">Close</button>
            </div>
            </div>
        </div>
    </div>

</div>
<script src="view/assets/js/publication/getpublish.js?v=3.3"></script>
<script src="view/assets/js/publication/index.js?v=1.0"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        //Traigo las provincias
        getProvincias();
        getData();
        getCurrency();
    });
</script>