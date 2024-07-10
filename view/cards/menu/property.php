<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-5">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-44">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="far fa-plus-square"></i></div>
                                Alta de nueva propiedad
                            </h1>
                            <div class="page-header-subtitle">Son aquellas nuevas propiedades que vas a administrar</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Gestión</li>
                            <li class="breadcrumb-item">Administración</li>
                            <li class="breadcrumb-item">Inmuebles</li>
                            <li class="breadcrumb-item active">Propiedad</li>
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
                        Nueva unidad
                    </p>
                </div>
                
                <div class="container-fluid">
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
                            
                            <label for="typeproperty"><a href="#" 
                                data-toggle="modal" 
                                data-target="#newProperty"
                                style="text-decoration:none"
                                ><i 
                                class="fas fa-plus-circle fa-1x" 
                               > 
                            </i> Agregar tipo de propiedad</a></label>
                            <select class="form-control" id="typepropertyw">
                                <option>Propiedad horizontal</option>
                                <option>Edificio</option>
                                <option>Country</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="street">Calle</label>
                            <input 
                                class="form-control" 
                                id="street" 
                                type="text" 
                                placeholder="Ejemplo: Pampa">
                        </div>

                        <div class="mb-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword7" class="col-form-label">Número</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="inputPassword7" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <div class="col-auto">
                                    <label for="cp1" class="col-form-label">CP</label>
                                </div>
                                <div class="col-auto">
                                    <input type="number" id="cp1" class="form-control" aria-describedby="passwordHelpInline">
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
                        
                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-4 row g-2" id="access_section">
                            <label for="access_section">Usuario único al sistema</label>
                            <div class="col-md">
                                <div class="form-floating">
                                <input type="text" class="form-control" id="userbuild" placeholder="pampa233" value="pampa">
                                <label for="userbuild">Usuario</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                <input type="password" class="form-control" id="passbuild" placeholder="Defina una contraseña" value="233">
                                <label for="passbuild">Password</label>
                                </div>
                            </div>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-3">
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="inputPassword6" class="col-form-label">Cantidad de pisos</label>
                                    <input type="number" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Desde</label>
                                    <input type="number" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                                </div>

                                <div class="col-auto">
                                    <label for="cp" class="col-form-label">Hasta</label>
                                    <input type="number" id="cp" value="222" class="form-control" aria-describedby="passwordHelpInline">
                                </div>
                            </div>
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

</div>
<!-- /.container-fluid -->

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getProvincias();
    });
</script>