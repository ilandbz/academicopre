<form name="docenteform" id="docenteform" action="docentes" method="POST">
    <div class="modal fade" id="modaldocente">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Docente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input type="hidden" name="id" value="">
                  <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres">
                </div>
                <div class="form-group">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
                </div>
                <div class="form-group">
                  <label for="dni">DNI</label>
                  <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI">
                </div>
                <div class="form-group">
                  <label for="dni">EMAIL</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Me@me.com">
                </div>                
                <div id="grupocontrasenha">
                  <div class="form-group">
                    <label for="dni">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="form-group">
                    <label for="dni">Contraseña Confirmar</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                  </div>
                </div>

                <div class="form-group">
                  <label>Sexo</label>
                  <select class="form-control" name="sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tipo de Contrato</label>
                  <select class="form-control" name="tipocontrato">
                    <option value="Contratado">Contratado</option>
                    <option value="Nombrado">Nombrado</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-dark">Guardar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->    
  </form>  