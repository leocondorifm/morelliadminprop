<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Pagos
                            </h1>
                            <div class="page-header-subtitle">Listado completo de los pagos informados</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Pagos informados
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Propiedad</th>
                                <th scope="col">Piso</th>
                                <th scope="col">Depto</th>
                                <th scope="col">UF</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ver</th>
                            </tr>
                        </thead>
                        <tbody id="getpayings">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       
    <hr>
    
    </main>

    <div class="modal fade" id="viewDetallesDePagos" tabindex="-1" aria-labelledby="viewDetallesDePagos" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreen"><i class="fas fa-eye"></i> Ver detalle de pagos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">Propiedad</th>
      <th scope="col">Piso</th>
      <th scope="col">Depto</th>
      <th scope="col">UF</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Jujuy 449</th>
      <td>1</td>
      <td>C</td>
      <td>76FR</td>
    </tr>
  </tbody>
</table>

<hr>
    <h6><i class="fas fa-file-archive"></i> Archivos</h6>
    <ul class="list-group">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
    <li class="list-group-item">A fourth item</li>
    <li class="list-group-item">And a fifth one</li>
</ul>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

</div>
<script src="view/assets/js/pay/getpayings.js?v=1.7"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getData();
    });
</script>