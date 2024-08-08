
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
                        <a class="nav-item nav-link" id="wizard2-tab" href="wizard.html#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="false">
                            <div class="wizard-step-icon">2</div>
                            <div class="wizard-step-text">
                                <div class="wizard-step-text-name"><i class="fas fa-newspaper"></i> Lista de distribución</div>
                                <div class="wizard-step-text-details">Seleccioná la lista de distribución</div>
                            </div>
                        </a>
                        <!-- Wizard navigation item 3-->
                        <a class="nav-item nav-link" id="wizard3-tab" href="wizard.html#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="false">
                            <div class="wizard-step-icon">3</div>
                            <div class="wizard-step-text">
                                <div class="wizard-step-text-name"><i class="fas fa-folder-plus"></i> Archivos</div>
                                <div class="wizard-step-text-details">Seleccioná los archivos</div>
                            </div>
                        </a>
                        <!-- Wizard navigation item 4-->
                        <a class="nav-item nav-link" id="wizard4-tab" href="wizard.html#wizard4" onclick="getModelData()" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="false">
                            <div class="wizard-step-icon">4</div>
                            <div class="wizard-step-text">
                                <div class="wizard-step-text-name"><i class="fas fa-paper-plane"></i> Revisión &amp; envío</div>
                                <div class="wizard-step-text-details">Validá los datos, guardalos y envialos</div>
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
                                            <label for="documentsadd">
                                                <a href="documents" 
                                                style="text-decoration:none"
                                                >
                                                <i 
                                                class="fas fa-plus-circle fa-1x" 
                                                > 
                                            </i> Agregar propiedad</a></label>
                                            <select class="form-control" id="documentsadd" onchange="getListDist()">
                                                
                                            </select>
                                        </div>
                                        <div id="validation-step"></div>
                                        <hr class="my-4" />
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-light disabled" type="button" disabled="">Atrás</button>
                                            <button class="btn btn-primary" id="btn-1" onclick="stepActive(1,2)" type="button">Siguiente</button>
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
                                                <a href="newsletteradd" style="text-decoration:none">
                                                <i class="fas fa-plus-circle fa-1x"> 
                                            </i> Agregar newsletter</a>
                                        </label>
                                            <select class="form-control" id="newsletteradd" onchange="getNewsletter()">
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">usuario</th>
                                                        <th scope="col">estado</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dataRemitente">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-4">
                                            <div class="container overflow-hidden text-center">
                                                <div class="row gx-5">
                                                    <div class="col">
                                                        <div class="p-3 text-success" id="countSuccess"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-3 text-danger" id="countDanger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-4" />
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-light" id="btn-2-1" type="button">Atrás</button>
                                            <button class="btn btn-primary" id="btn-2" type="button">Siguiente</button>
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
                                    <div class="mb-4">
                                        <label for="filedata">
                                            <a href="documents" style="text-decoration:none">
                                            <i class="fas fa-plus-circle fa-1x"> 
                                        </i> Agregar archivos</a></label>
                                        <select class="form-control" id="filedata" onchange="getAllFile()">
                                        </select>
                                    </div>
                                        <hr class="my-4" />
                                        <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Extensión</th>
                                            <th scope="col">Ruta</th>
                                            <th class="text-center" scope="col">Descargar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="filestorage">

                                        </tbody>
                                        </table>
                                        <hr class="my-4" />
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-light" id="btn-3-2" type="button">Atrás</button>
                                            <button class="btn btn-primary" id="btn-3" type="button">Siguiente</button>
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
                                    <h5 class="card-title mb-4">Revisa cuidadosamente todos los datos configurados.</h5>

                                    <hr class="my-4" />

                                    <?php include('template/notification.php'); ?>

                                    <hr class="my-4" />
                                    <section id="info-validation" style="display:none">
                                        <div class="alert alert-danger logactivity" role="alert">
                                            
                                        </div>
                                    </section>
                                    
                                    <section id="result-envio" style="display:none"></section>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-light" id="btn-4-3" type="button">Atrás</button>
                                        <button class="btn btn-info" id="test-send" onclick="saveNeswLetterAndSend('test')"  style="display:none" type="button"><i class="fas fa-paper-plane"></i> Test</button>
                                        <button class="btn btn-light" id="btn-4" onclick="validateDataAndSave()" type="button"><i class="fas fa-check"></i> Validar</button>
                                        <button class="btn btn-success" id="save-send" style="display:none" onclick="saveNeswLetterAndSend('prod')" type="button"><i class="fas fa-save"></i> Enviar</button>
                                    </div>

                                    <hr class="my-4" />

                                    <div class="alert alert-light" id="help-info" role="alert">
                                        <i class="fas fa-check"></i> Realiza todas las validaciones necesarias para que el envío de notificación sea todo correcto.
                                    </div>
                                    <div class="alert alert-info" id="help-send" style="display:none" role="alert">
                                        <i class="fas fa-paper-plane"></i> Usando esta función podés enviarte un email para chequear que todo está correcto.
                                    </div>
                                    <div class="alert alert-success" id="help-save" style="display:none" role="alert">
                                        <i class="fas fa-save"></i> Guardar y enviar newsletter.
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="view/assets/js/documents/index.js?v=4.6"></script>
        <script src="view/assets/js/send/index.js?v=3.8"></script>

        <script>
            window.addEventListener('DOMContentLoaded', event => {

                setGetPropertySend();

                /*::::::::::::::::::_ HEAD NEXT/BACK _:::::::::::::::::::::::::*/
                document.getElementById('wizard2-tab').addEventListener('click', function() {
                    
                    if(stepValidation(1,2)){
                        $("#validation-step").html('');
                        $("#validation-step").html('<div class="alert alert-warning" role="alert">'+
                                                        'Debe seleccionar planificación para la propiedad!'+
                                                    '</div>');
                    return false;

                    }else{//Pasó las validacione y está ok.
                        $("#validation-step").html('');
                        document.getElementById('wizard2-tab').click();
                    }
                });
                document.getElementById('wizard3-tab').addEventListener('click', function() {
                    document.getElementById('wizard3-tab').click();
                });
                document.getElementById('wizard4-tab').addEventListener('click', function() {
                    document.getElementById('wizard4-tab').click();
                });

                /*::::::::::::::::::_ BUTTON NEXT/BACK _:::::::::::::::::::::::::*/
                document.getElementById('btn-1').addEventListener('click', function() {
                    
                    if(stepValidation(1,2)){
                        $("#validation-step").html('');
                        $("#validation-step").html('<div class="alert alert-warning" role="alert">'+
                                                        'Debe seleccionar planificación para la propiedad!'+
                                                    '</div>');
                    }else{//Pasó las validacione y está ok.
                        $("#validation-step").html('');
                        document.getElementById('wizard2-tab').click();
                    }
                });
                document.getElementById('btn-2').addEventListener('click', function() {
                    document.getElementById('wizard3-tab').click();
                });
                document.getElementById('btn-3').addEventListener('click', function() {
                    document.getElementById('wizard4-tab').click();
                });
                document.getElementById('btn-4-3').addEventListener('click', function() {
                    document.getElementById('wizard3-tab').click();
                });
                document.getElementById('btn-3-2').addEventListener('click', function() {
                    document.getElementById('wizard2-tab').click();
                });
                document.getElementById('btn-2-1').addEventListener('click', function() {
                    document.getElementById('wizard1-tab').click();
                });

            });
        </script>