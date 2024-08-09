<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="filter"></i></div>
                                Newsletter
                            </h1>
                            <div class="page-header-subtitle">Listado completo de los Newsletters</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">
                    Newsletter
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Propiedad</th>    
                                <th scope="col">Newsletter</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody id="getnewsletter">
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
                    <h1 class="modal-title fs-4" id="exampleModalFullscreen">Editar newsletter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-4">
                            <label for="shortname">Asunto de correo de distribución</label>
                            <input 
                                class="form-control" 
                                id="subject" 
                                type="text" 
                                placeholder="Ejemplo: Expensas mensuales">
                        </div>
                        <div class="mb-4">
                            
                            <label for="typepropertynews"> 
                                <a href="property" 
                                style="text-decoration:none"
                                >
                                <i 
                                class="fas fa-plus-circle fa-1x" 
                                > 
                            </i> Agregar propiedad</a></label>
                            <select class="form-control" id="typepropertynews">
                                
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="body_mail">Texto del cuerpo del email</label>
                            <textarea class="form-control" id="body_mail" rows="3">Estimados vecinos...</textarea>
                        </div>
                        
                        <hr class="sidebar-divider d-none d-md-block">

                        <div class="mb-0">
                            <label for="emails">Agregar email destinatarios (separados por ;) </label>
                            <textarea class="form-control" id="emails" rows="3">lcondori@gmail.com;dmorelli@gmail.com</textarea>
                        </div>

                        <hr class="sidebar-divider d-none d-md-block">
                        <!-- ID DE PROPIEDAD -->
                        <input type="hidden" id="id_newsletter" />
                        <div class="mb-4 save-news response">
                            <p class="text-end">
                                <button type="button" onclick="putNewsletter()" class="btn btn-outline-primary">
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
    <script src="view/assets/js/newsletter/getnewsletter.js?v=2.2"></script>
    <script src="view/assets/js/newsletter/index.js?v=0.0"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getNewsletter();
        setGetBuild();
    });
</script>
        