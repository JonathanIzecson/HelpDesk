<div id="modalmantenimiento" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="lbltitulomodal"></h4>
            </div>
            <div class="modal-body">
                <form method="post" id="usuario_form">

                    <input type="hidden" name="usu_id" id="usu_id">
                    <div class="form-group">
                        <label class="form-label" for="usu_nom">Nombre</label>
                        <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Fulanito">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_ape">Apellido</label>
                        <input type="text" class="form-control" id="usu_ape" name="usu_ape" placeholder="Rodriguez">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_correo">Correo</label>
                        <input type="text" class="form-control" id="usu_correo" name="usu_correo" placeholder="fulanito_rdg@example.com">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="usu_pass">Contraseña</label>
                        <input type="text" class="form-control" id="usu_pass" name="usu_pass" placeholder="*********">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rol_id">Rol</label>
                        <select class="select2" id="rol_id" name="rol_id">
                            <option value="1">Usuario</option>
                            <option value="2">Soporte</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btnguardar" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<!--.modal-->