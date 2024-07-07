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
                            <label for="typeproperty">Propiedad</label>
                            <select class="form-control" id="typeproperty" disabled>
                                <option>Pampa 233</option>
                            </select>
                        </div>

                        <div class="mb-4">  
                            <label for="typeproperty">Dato sobre el pago</label>
                            <select class="form-control" id="month">
                                        <option>Pagué el total</option>
                                        <option>Pagué de menos</option>
                                        <option>Pagué de más</option>
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
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option selected>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <label for="anio" class="col-form-label">Año</label>
                                </div>
                                <div class="col-auto">
                                <select class="form-control" id="year">
                                        <option>2010</option>
                                        <option>2011</option>
                                        <option>2012</option>
                                        <option>2013</option>
                                        <option>2014</option>
                                        <option>2015</option>
                                        <option>2016</option>
                                        <option>2017</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                        <option>2022</option>
                                        <option>2023</option>
                                        <option selected>2024</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="typeproperty">Indique su unidad</label>
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label for="month" class="col-form-label">Piso</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="month">
                                        <option selected>PB</option>    
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>

                                <div class="col-auto">
                                    <label for="anio" class="col-form-label">Unidad</label>
                                </div>
                                <div class="col-auto">
                                <select class="form-control" id="year">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                        <option>13</option>
                                        <option>14</option>
                                        <option selected>15</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-4">
                            <label class="input-group-text" for="inputGroupFile01">Subir</label>
                            <input type="file" class="form-control" id="inputGroupFile01">
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