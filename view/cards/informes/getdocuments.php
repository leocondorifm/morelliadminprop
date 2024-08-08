<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Documentos
                            </h1>
                            <div class="page-header-subtitle">Listado completo de documentos para newsletters</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Documentos
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre de archivo</th>
                                <th scope="col">Propiedad</th>
                                <th scope="col">Newsletter</th>
                                <th scope="col">Mes</th>
                                <th scope="col">Año</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="getdocuments">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    <hr>
    
    </main>

    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreen" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="exampleModalFullscreen">Editar documentos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
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
                                    <label for="anio" class="col-form-label">Año</label>
                                </div>
                                <div class="col-auto">
                                <select class="form-control" id="year">
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="view/assets/js/documents/getdocuments.js?v=1.1"></script>
    <script src="view/assets/js/documents/index.js?v=0.4"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getData();
        setGetBuild();
        setGetPlain();
    });
</script>
        