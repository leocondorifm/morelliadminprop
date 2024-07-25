<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                Gestión de pagos
                            </h1>
                            <div class="page-header-subtitle">Informar que realizaste un pago</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item">Gestión</li>
                            <li class="breadcrumb-item">Administración</li>
                            <li class="breadcrumb-item">Inmuebles</li>
                            <li class="breadcrumb-item active">Gestión de pagos</li>
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
                        <i class="fas fa-file-alt"></i> 
                        Informar un pago
                    </p>
                </div>
                <div class="card-body">Si tiene más de una comprobante deberá realizar el registro uno a la vez. Desde los informes disponibles en su perfil, podrá consultar todos los documentos que informó.</div>
                
                <div class="container-fluid">
                    <form>

                        <div class="mb-4">  
                            <label for="payproperty">Propiedad</label>
                            <select class="form-control" id="payproperty" onchange="setFloors()" disabled>
                            </select>
                        </div>

                        <div class="mb-4">  
                            <label for="typeproperty">Dato sobre el pago</label>
                            <select class="form-control" id="paydata">
                                        <option value="none">Seleccione aviso</option>
                                        <option value="100">Pagué el total</option>
                                        <option value="0">Pagué de menos</option>
                                        <option value="200">Pagué de más</option>
                                    </select>
                        </div>
                        <div class="mb-3">
                            <label for="typeproperty">Período</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="month" class="col-form-label">Mes</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="month">
                                        <option value="0">Mes</option>    
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <label for="year" class="col-form-label">Año</label>
                                </div>
                                <div class="col-auto">
                                <select class="form-control" id="year">
                                        <option value="0">Año</option>        
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="typeproperty">Indique su unidad</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="floors" class="col-form-label">Piso</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="floors">
                                       <option>0</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <label for="depto" class="col-form-label">Depto</label>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" id="depto" placeholder="A">
                                </div>
                            </div>
                        </div>


                        <div class="input-group mb-4">
                            <label class="input-group-text" for="filepay">Subir</label>
                            <input type="file" class="form-control" id="filepay">
                        </div>

                        <div class="mb-4">
                            <label for="docsrar">Nota</label>
                            <input 
                                class="form-control" 
                                id="paynote" 
                                type="text" 
                                placeholder="Ejemplo: adjunto documento">
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">
                        <section id="save-pay"></section>
                        <div class="mb-4">
                            <p class="text-end">
                                <button type="button" onclick="savePay()" class="btn btn-outline-primary">
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

<script src="view/assets/js/pay/index.js?v=1.3"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        
        let owner = $("#owner").val();
        let id_build = $("#id_build").val();
        let name = $("#usermail").val();

        getPropertyPay(owner,id_build,name);

    });
</script>