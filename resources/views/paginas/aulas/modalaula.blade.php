<form name="aulaform" id="aulaform" action="aulas" method="POST">
    <div class="modal fade" id="modalaula">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-warning">
            <h4 class="modal-title tex-dark" id="titulo-modal">Nuevo Programa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="id" value="">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="piso">Piso</label>
                  <input type="text" class="form-control" id="piso" name="piso" placeholder="">
                </div>
                <div class="form-group">
                  <label for="numero">Numero</label>
                  <input type="text" class="form-control" id="numero" name="numero" placeholder="">
                </div>                
                <div class="form-group">
                  <label for="aforo">Aforo</label>
                  <input type="text" class="form-control" id="aforo" name="aforo" placeholder="">
                </div>
                <div class="form-group">
                  <label for="seccion">Seccion</label>
                  <input type="text" class="form-control" id="seccion" name="seccion" placeholder="">
                </div>
                <div class="form-group">
                  <label for="status">Estado</label>
                  <select name="status" id="status" class="form-control">
                    <option value="Libre">Libre</option>
                    <option value="Ocupado">Ocupado</option>
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