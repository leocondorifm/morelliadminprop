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
                            <label for="shortname">Título</label>
                            <input 
                                class="form-control" 
                                id="shortname" 
                                type="text" 
                                placeholder="Alquiler Amoblado Colegiales 2 Amb">
                        </div>

                        <div class="mb-4">
                            <label for="street">Calle</label>
                            <input 
                                class="form-control" 
                                id="street" 
                                type="text" 
                                placeholder="Ejemplo: Pampa">
                        </div>

                        <div class="row gx-4 mb-4">
                            <label for="inputPhone">Entre calles:</label>
                            <div class="col-md-6 mb-md-0">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567" />
                            </div>
                            <div class="col-md-6 mb-0">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="street">Provincia</label>
                            <select class="form-control" id="province">
                                <option>Ciudad Autónoma de Buenos Aires</option>
                                <option>Buenos Aires</option>
                                <option>Catamarca</option>
                            </select>  
                        </div>

                        <div class="mb-3">
                            <label for="street">Partido</label>
                            <select class="form-control" id="partido">
                                <option>Partido</option>
                                <option>Buenos Aires</option>
                                <option>Catamarca</option>
                            </select>  
                        </div>
                        <div class="mb-4">
                            <label for="street">Localidad</label>
                            <select class="form-control" id="partido">
                                <option>Localidad</option>
                                <option>Buenos Aires</option>
                                <option>Catamarca</option>
                            </select>  
                        </div>
                        
                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="row gx-3 md-4 mb-4">
                            <div class="col-md-4 mb-md-0">
                                <label class="small mb-1" for="inputPhone">Precio</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Ingrese el precio" value="555-123-4567" />
                            </div>
                            <div class="col-md-4 mb-md-0">
                                <label for="typeproperty">
                                    <a href="#" 
                                    data-toggle="modal" 
                                    data-target="#newProperty"
                                    style="text-decoration:none"
                                    >
                                    <i class="fas fa-plus-circle fa-1x"></i>
                                    Agregar moneda</a>
                                </label>
                                <select class="form-control" id="partido">
                                <option>$</option>
                                <option>USD</option>
                                <option>EU</option>
                            </select>
                            </div>
                            <div class="col-md-4 mb-0">
                                <label class="small mb-1" for="inputBirthday">Fecha de publicación</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="06/10/1988" />
                            </div>
                        </div>

                        <div class="row gx-3 md-4 mb-4">
                            <div class="col-md-4 mb-md-0">
                                <label class="small mb-1" for="inputPhone">Metros</label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Ingrese el precio" value="52 metros" />
                            </div>
                            <div class="col-md-4 mb-md-0">
                                <label for="typeproperty">
                                    Dormitorios
                                </label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Ingrese el precio" value="3"/>
                            </div>
                            <div class="col-md-4 mb-md-0">
                                <label for="typeproperty">
                                    Baños
                                </label>
                                <input class="form-control" id="inputPhone" type="tel" placeholder="Ingrese el precio" value="1"/>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="row gx-3 md-4 mb-4">
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Amoblado</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Ascensor</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Terraza</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Cocheras</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Laundry</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Pileta</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="row gx-3 md-4 mb-4">
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Admite mascotas: </label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Bauleras</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Aire acondicionado</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Apto profesional</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">Barrio cerrado</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-md-0">
                                <label for="typeproperty">SUM</label>
                                <select class="form-control" id="partido">
                                    <option>Si</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">
                        
                        <div class="mb-4">
                            <label for="exampleFormControlTextarea1">Descripción</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-4"><p class="text-end">
                        <button type="button" class="btn btn-outline-primary"><i class="fas fa-save"></i></button>
                    </p></div>
                    </form>
                    
                </div>

                <hr class="sidebar-divider">
            </div>
            
        </div>
    </main>
    <footer class="footer-admin mt-auto footer-light">
        <div class="container-xl px-4">
            <div class="row">
                <div class="col-md-6 small">Copyright © Your Website 2021</div>
                <div class="col-md-6 text-md-end small">
                    <a href="header-breadcrumbs.html#!">Privacy Policy</a>
                    ·
                    <a href="header-breadcrumbs.html#!">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- /.container-fluid -->