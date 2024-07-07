<div id="layoutSidenav_content">
                <main>
                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
                        <div class="container-xl px-4">
                            <div class="page-header-content pt-4">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mt-4">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i class="fas fa-paper-plane"></i></div>
                                            Envío masivo de correo electrónico
                                        </h1>
                                        <div class="page-header-subtitle">Gestioná el envío masivo de email a los propietarios y co propietarios</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-n10">
                        <!-- Wizard card example with navigation-->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <!-- Wizard navigation-->
                                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                                    <!-- Wizard navigation item 1-->
                                    <a class="nav-item nav-link active" id="wizard1-tab" href="wizard.html#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                                        <div class="wizard-step-icon">1</div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name"><i class="far fa-building"></i> Propiedad</div>
                                            <div class="wizard-step-text-details">Seleccione la propiedad</div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 2-->
                                    <a class="nav-item nav-link" id="wizard2-tab" href="wizard.html#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                                        <div class="wizard-step-icon">2</div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name"><i class="fas fa-newspaper"></i> Lista de distribución</div>
                                            <div class="wizard-step-text-details">Seleccioná la lista de distribución</div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 3-->
                                    <a class="nav-item nav-link" id="wizard3-tab" href="wizard.html#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                                        <div class="wizard-step-icon">3</div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name"><i class="fas fa-folder-plus"></i> Archivos</div>
                                            <div class="wizard-step-text-details">Seleccioná los archivos</div>
                                        </div>
                                    </a>
                                    <!-- Wizard navigation item 4-->
                                    <a class="nav-item nav-link" id="wizard4-tab" href="wizard.html#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                                        <div class="wizard-step-icon">4</div>
                                        <div class="wizard-step-text">
                                            <div class="wizard-step-text-name"><i class="fas fa-paper-plane"></i> Revisión &amp; envío</div>
                                            <div class="wizard-step-text-details">Review and submit changes</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="cardTabContent">
                                    <!-- Wizard tab pane item 1-->
                                    <div class="tab-pane py-5 py-xl-10 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="far fa-building"></i> Paso 1</h3>
                                                <h5 class="card-title mb-4">Seleccione la propiedad</h5>
                                                
                                                <form>
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

                                                    <hr class="my-4" />
                                                    <div class="d-flex justify-content-between">
                                                        <button class="btn btn-light disabled" type="button" disabled="">Atrás</button>
                                                        <button class="btn btn-primary" type="button">Siguiente</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Wizard tab pane item 2-->
                                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="fas fa-newspaper"></i>  Paso 2</h3>
                                                <h5 class="card-title mb-4">Seleccione la lista de distribución</h5>
                                                <form>

                                                    <div class="mb-4">
                                                        <label for="typeproperty">
                                                            <a href="newsletter" 
                                                            style="text-decoration:none"
                                                            >
                                                            <i 
                                                            class="fas fa-plus-circle fa-1x" 
                                                            > 
                                                        </i> Agregar newsletter</a></label>
                                                        <select class="form-control" id="typeproperty">
                                                            <option>No hay lista de distribución</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">First</th>
                                                                <th scope="col">Last</th>
                                                                <th scope="col">Handle</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                <th scope="row">1</th>
                                                                <td>Mark</td>
                                                                <td>Otto</td>
                                                                <td>@mdo</td>
                                                                </tr>
                                                                <tr>
                                                                <th scope="row">2</th>
                                                                <td>Jacob</td>
                                                                <td>Thornton</td>
                                                                <td>@fat</td>
                                                                </tr>
                                                                <tr>
                                                                <th scope="row">3</th>
                                                                <td colspan="2">Larry the Bird</td>
                                                                <td>@twitter</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="mb-4">
                                                        <div class="container overflow-hidden text-center">
                                                            <div class="row gx-5">
                                                                <div class="col">
                                                                    <div class="p-3 text-success"><i class="fas fa-check-square"></i> Cantidad correctos: 453</div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="p-3 text-danger"><i class="fas fa-exclamation-triangle"></i> Cantidad incorrectos: 4</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-4" />
                                                    <div class="d-flex justify-content-between">
                                                        <button class="btn btn-light" type="button">Atrás</button>
                                                        <button class="btn btn-primary" type="button">Siguiente</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Wizard tab pane item 3-->
                                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="fas fa-folder-plus"></i>  Paso 3</h3>
                                                <h5 class="card-title mb-4">Seleccione los archivos que se van adjuntar.</h5>
                                                <form>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" id="checkAccountChanges" type="checkbox" checked="" />
                                                        <label class="form-check-label" for="checkAccountChanges">Changes made to your account</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" id="checkAccountGroups" type="checkbox" checked="" />
                                                        <label class="form-check-label" for="checkAccountGroups">Changes are made to groups you're part of</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" id="checkProductUpdates" type="checkbox" checked="" />
                                                        <label class="form-check-label" for="checkProductUpdates">Product updates for products you've purchased or starred</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" id="checkProductNew" type="checkbox" checked="" />
                                                        <label class="form-check-label" for="checkProductNew">Information on new products and services</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" id="checkPromotional" type="checkbox" />
                                                        <label class="form-check-label" for="checkPromotional">Marketing and promotional offers</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="checkSecurity" type="checkbox" checked="" disabled="" />
                                                        <label class="form-check-label" for="checkSecurity">Security alerts</label>
                                                    </div>
                                                    <hr class="my-4" />
                                                    <div class="d-flex justify-content-between">
                                                        <button class="btn btn-light" type="button">Previous</button>
                                                        <button class="btn btn-primary" type="button">Next</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Wizard tab pane item 4-->
                                    <div class="tab-pane py-5 py-xl-10 fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                                        <div class="row justify-content-center">
                                            <div class="col-xxl-6 col-xl-8">
                                                <h3 class="text-primary"><i class="fas fa-paper-plane"></i> Paso 4</h3>
                                                <h5 class="card-title mb-4">Review the following information and submit</h5>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Username:</em></div>
                                                    <div class="col">username</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Name:</em></div>
                                                    <div class="col">Valerie Luna</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Organization Name:</em></div>
                                                    <div class="col">Start Bootstrap</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Location:</em></div>
                                                    <div class="col">San Francisco, CA</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Email Address:</em></div>
                                                    <div class="col"><a href="cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0d636c60684d68756c607d6168236e6260">[email&#160;protected]</a></div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Phone Number:</em></div>
                                                    <div class="col">555-123-4567</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Birthday:</em></div>
                                                    <div class="col">06/10/1988</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Credit Card Number:</em></div>
                                                    <div class="col">**** **** **** 1111</div>
                                                </div>
                                                <div class="row small text-muted">
                                                    <div class="col-sm-3 text-truncate"><em>Credit Card Expiration:</em></div>
                                                    <div class="col">06/2024</div>
                                                </div>
                                                <hr class="my-4" />
                                                <div class="d-flex justify-content-between">
                                                    <button class="btn btn-light" type="button">Previous</button>
                                                    <button class="btn btn-primary" type="button">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright © Your Website 2021</div>
                            <div class="col-md-6 text-md-end small">
                                <a href="wizard.html#!">Privacy Policy</a>
                                ·
                                <a href="wizard.html#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>