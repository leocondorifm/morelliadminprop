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
                    ...
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="view/assets/js/documents/getdocuments.js?v=1.1"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getData();
    });
</script>
        