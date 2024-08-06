<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Prestadores de Servicios de urgencias
                            </h1>
                            <div class="page-header-subtitle">Disponibilizamos el listado de prestadores autorizados como prestadores de urgencias</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Profesionales y empresas habilitadas
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>

                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="getproperty">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    <hr>
    
    </main>

    <div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreen" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreen">Full screen modal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

</div>
<script src="view/assets/js/property/getproperty.js?v=1.0"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getProperty();       
    });
</script>