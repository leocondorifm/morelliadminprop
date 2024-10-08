<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="fab fa-wpforms"></i></div>
                                Nueva publicación
                            </h1>
                            <div class="page-header-subtitle">Son aquellas nuevas propiedades que vas a publicar para vender o alquilar</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Gestión</li>
                            <li class="breadcrumb-item">Inmobiliaria</li>
                            <li class="breadcrumb-item">Inmuebles</li>
                            <li class="breadcrumb-item active">Ficha</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10 ">
            <div class="card">
                <div class="mb-3 card-header">
                    <p class="text-start">
                        <i class="far fa-building"></i> 
                        Nueva publicación
                    </p>
                </div>
                
                <div class="container-fluid">
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
                                <label for="currency">
                                    <a href="#" data-toggle="modal" data-target="#newCurrency" style="text-decoration:none">
                                    <i class="fas fa-plus-circle fa-1x"></i>
                                    Agregar moneda</a>
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
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Ascensor</label>
                                <select class="form-control" id="ascensor">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Terraza</label>
                                <select class="form-control" id="terraza">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Cocheras</label>
                                <select class="form-control" id="cocheras">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Laundry</label>
                                <select class="form-control" id="laundry">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Pileta</label>
                                <select class="form-control" id="pileta">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row gx-3 md-4 mb-4">
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Admite mascotas: </label>
                                <select class="form-control" id="mascota">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Bauleras</label>
                                <select class="form-control" id="bauleras">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Aire acond.</label>
                                <select class="form-control" id="aa">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Apto profesional</label>
                                <select class="form-control" id="ap">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Barrio cerrado</label>
                                <select class="form-control" id="barrioc">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">SUM</label>
                                <select class="form-control" id="sum">
                                    <option value="si">Si</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">
                        
                        <div class="mb-4">
                            <label for="long_description">Descripción</label>
                            <textarea class="form-control" id="long_description" rows="3"></textarea>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="input-group mb-0">
                            <label class="input-group-text" for="filepublish">Fotos</label>
                            <input type="file" class="form-control" id="filepublish" name="file" accept=".zip">
                        </div>

                        <hr class="sidebar-divider d-none d-md-block t">
                        <section id="save-publish"></section>
                        <div class="mb-4"><p class="text-end">
                        <button type="button" onclick="publishNow()" class="btn btn-outline-primary"><i class="fas fa-save"></i></button>
                    </p></div>
                    </form>
                    
                </div>

                <hr class="sidebar-divider">
            </div>
            
        </div>
    </main>

</div>
<!-- /.container-fluid -->

<script src="view/assets/js/publication/index.js?v=1.2"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        //Traigo las provincias
        getProvincias();
        
        //Seteo la fecha actual en campo: Fecha de publicación
        const dateInput = document.getElementById('date_publish');
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const formattedDate = `${year}-${month}-${day}`;
        console.log(formattedDate);
        dateInput.value = formattedDate;

        //Función para cerrar el modal de Moneda.
        $("#close-mod-currency").click(function(){
            $("#x-close-c").trigger('click');
        });

        getCurrency();
    });
</script>