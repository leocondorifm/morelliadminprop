    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿De verdad querés cerrar la sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Todos los cambios que no hayas guardado se perderán y no se podrán recuperar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger" href="logout">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="newProperty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-plus-circle"></i> Nuevo tipo de propiedad
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" id="x-close" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 text-center">
                        <div id="section-prop" class="" role="alert" style="display:none">
                        </div>
                        <div class="col-auto" id="mod-input">
                            <label for="addTypeproperty" class="visually-hidden"> Tipo de propiedad</label>
                            <input type="text" class="form-control" id="addTypeproperty" placeholder="Ej: Barrio cerrado">

                        </div>

                        <div class="modal-footer" id="action-save-tip">
                            <button type="button" onclick="setPostTipoProp()" class="btn btn-primary"><i class="fas fa-save"></i> guardar</button>
                            <button type="button" class="btn btn-secondary" id="close-mod-prop" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    