<form name="cursoform" id="cursoform" action="cursos" method="POST">
    <div class="modal fade" id="modalprograma">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Curso</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="">
                  <label for="nombre">NOMBRE</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="credito">Credito</label>
                  <input type="text" class="form-control" id="credito" name="credito" placeholder="">
                </div>
                <div class="form-group">
                  <label for="estado">Estado</label>
                  <select name="estado" id="estado" class="form-control" required>
                    <option value="Libre">Libre</option>
                    <option value="Asignado">Asignado</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tipo">Tipo</label>
                  <select name="tipo" id="tipo" class="form-control" required>
                    <option value="Semestral">Semestral</option>
                    <option value="Electivo">Electivo</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="estadodocente">Estado Docente</label>
                  <select name="estadodocente" id="estadodocente" class="form-control">
                    <option value="PENDIENTE">PENDIENTE</option>
                    <option value="DICTANDO">DICTANDO</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="codigo">CODIGO</label>
                  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Nombre">
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