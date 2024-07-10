<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="fas fa-newspaper"></i></div>
                                Gestión de notificaciones por propiedad
                            </h1>
                            <div class="page-header-subtitle">Administrá las notificaciones que van a recibir los destinatarios</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Gestión</li>
                            <li class="breadcrumb-item">Administración</li>
                            <li class="breadcrumb-item">Inmuebles</li>
                            <li class="breadcrumb-item active">Newsletter</li>
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
                        <i class="fas fa-envelope"></i> 
                        Destinatarios
                    </p>
                </div>
                
                <div class="container-fluid">
                    <form>
                        <div class="mb-4">
                            <label for="shortname">Asunto de correo de distribución</label>
                            <input 
                                class="form-control" 
                                id="shortname" 
                                type="text" 
                                placeholder="Ejemplo: Expensas mensuales">
                        </div>
                        <div class="mb-4">
                            
                            <label for="typeproperty">
                                <a href="property" 
                                style="text-decoration:none"
                                >
                                <i 
                                class="fas fa-plus-circle fa-1x" 
                                > 
                            </i> Agregar propiedad</a></label>
                            <select class="form-control" id="typeproperty">
                                <option>No hay propiedades</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="destinatarios">Texto del cuerpo del email</label>
                            <textarea class="form-control" id="destinatarios" rows="3">Estimados vecinos...</textarea>
                        </div>
                        
                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-0">
                            <label for="destinatarios">Agregar email destinatarios (separados por ;) </label>
                            <textarea class="form-control" id="destinatarios" rows="3">lcondori@gmail.com;dmorelli@gmail.com</textarea>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-4">
                            <p class="text-end">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="fas fa-save"></i>
                                </button>
                            </p>
                        </div>
                    </form>
                    
                </div>

                <hr class="sidebar-divider">
            </div>
            
        </div>
    </main>

</div>
<!-- /.container-fluid -->