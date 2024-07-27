<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <main class="container">
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                
                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 text-bg-dark rounded-3">
                        <form>
                            <div class="mb-3">
                                <label for="ser-url" class="form-label"><i class="fas fa-globe"></i> Imagen</label>
                                <input type="text" onchange="previewService('ser-url')" class="form-control" id="ser-url">
                                <div id="emailHelp" class="form-text" style="display:none">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="ser-tit" class="form-label"><i class="fas fa-wrench"></i> Servicio</label>
                                <input type="text" onchange="previewService('ser-tit')" class="form-control" id="ser-tit">
                            </div>
                            <div class="mb-3">
                                <label for="ser-des" class="form-label"><i class="fas fa-quote-right"></i> Descripción</label>
                                <input type="text" onchange="previewService('ser-des')"  class="form-control" id="ser-des">
                            </div>
                            <div class="mb-3">
                                <label for="ser-con"  class="form-label"><i class="fas fa-user-check"></i> Contacto</label>
                                <input type="text" onchange="previewService('ser-con')" class="form-control" id="ser-con">
                            </div>
                            <div class="mb-3">
                                <label for="ser-tel" class="form-label"><i class="fas fa-phone-volume"></i> Teléfono</label>
                                <input type="text" onchange="previewService('ser-tel')"  class="form-control" id="ser-tel">
                            </div>
                            <section id="save-service"></section>
                            <button type="button" onclick="saveService()" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="col">
                        <h2><i class="fas fa-eye"></i> Preview</h2>
                        <div class="card shadow-sm">
                            <img id="ser-url-prev" src="https://images.unsplash.com/photo-1637193080311-a6e6e11f0e00?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="bd-placeholder-img card-img-top" width="100%" height="220">
                            <div class="card-body">
                                <h5 id="ser-tit-prev">PLOMERIA</h5>
                                <p class="card-text" id="ser-des-prev">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <small class="text-body-secondary"><i class="fas fa-phone-square-alt"></i> <span id="ser-tel-prev">011-4567-000</span></small>
                                <small class="text-body-secondary"><i class="fas fa-male"></i> <span id="ser-con-prev">Claudio Caniggia</span></small>
                            </div>
                        </div>
                    </div> 
                    </div>
                </div>

                <hr class="sidebar-divider">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 allservice">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1637193080311-a6e6e11f0e00?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="bd-placeholder-img card-img-top" width="100%" height="200">
                            <div class="card-body">
                                <h5>PLOMERIA</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <small class="text-body-secondary"><i class="fas fa-phone-square-alt"></i> 011-4567-000</small>
                                <small class="text-body-secondary"><i class="fas fa-male"></i> Claudio Caniggia</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    <div class="card shadow-sm">
                    <img src="https://images.unsplash.com/photo-1637193080311-a6e6e11f0e00?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    class="bd-placeholder-img card-img-top" width="100%" height="200">
                        <div class="card-body">
                        <h5>PLOMERIA</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <small class="text-body-secondary"><i class="fas fa-phone-square-alt"></i> 011-4567-000</small>
                            <small class="text-body-secondary"><i class="fas fa-male"></i> Claudio Caniggia</small>
                        </div>
                    </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="https://images.unsplash.com/photo-1637193080311-a6e6e11f0e00?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            class="bd-placeholder-img card-img-top" width="100%" height="200">
                            <div class="card-body">
                                <h5>PLOMERIA</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <small class="text-body-secondary"><i class="fas fa-phone-square-alt"></i> 011-4567-000</small>
                                <small class="text-body-secondary"><i class="fas fa-male"></i> Claudio Caniggia</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- /.container-fluid -->

<script src="view/assets/js/services/index.js?v=2.2"></script>

<script>
    window.addEventListener('DOMContentLoaded', event => {
        getService();
    });
</script>