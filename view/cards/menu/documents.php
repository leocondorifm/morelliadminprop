<!-- Begin Page Content -->
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i class="fas fa-folder-plus"></i></div>
                                Gestión de documentos
                            </h1>
                            <div class="page-header-subtitle">Administrá los archivos que querés distribuir a los destinatarios asociados a las propiedades</div>
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
                        <i class="fas fa-file-alt"></i> 
                        Documentos
                    </p>
                </div>
                <div class="card-body">El archivo que vas a subir tiene que estar en formato [.ZIP]</div>
                
                <div class="container-fluid">
                    <form>
                        <div class="mb-4">
                            <label for="namefiles">Nombre de la carpeta del documento</label>
                            <input 
                                class="form-control" 
                                id="namefiles" 
                                type="text" 
                                placeholder="Ejemplo: expensas_agosto24.zip">
                        </div>
                        <div class="mb-4">
                            
                            <label for="propertyfile">
                                <a href="property" 
                                style="text-decoration:none"
                                >
                                <i 
                                class="fas fa-plus-circle fa-1x" 
                                > 
                            </i> Agregar propiedad</a></label>
                            <select class="form-control" id="propertyfile">

                            </select>
                        </div>

                        <div class="mb-4">
                            
                            <label for="newsletterplain">
                                <a href="newsletter" 
                                style="text-decoration:none"
                                >
                                <i 
                                class="fas fa-plus-circle fa-1x" 
                                > 
                            </i> Agregar newsletter</a></label>
                            <select class="form-control" id="newsletterplain">
                            </select>
                        </div>

                        <div class="mb-3">
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

                        <div class="input-group mb-0">
                            <label class="input-group-text" for="file">Subir</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".zip">
                        </div>

                        <hr class="sidebar-divider d-none d-md-block t">

                        <div class="mb-4 file-save-alert">
                            <p class="text-end file-save">
                                <button type="button" onclick="postFileData()" class="btn btn-outline-primary">
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

<script src="view/assets/js/documents/index.js?v=0.4"></script>
<script>
    window.addEventListener('DOMContentLoaded', event => {
        setGetBuild();
        setGetPlain();
    });
</script>